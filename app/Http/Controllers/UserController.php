<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Checkout;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class UserController extends Controller
{
    // logic untuk mengelola tampilan data product dan detail product di website utama
    public function index()
    {
        $products = Product::Where('stock', '>', 0) 
                ->latest()
                ->get();
                
        return view('welcome', compact('products'));
    }

    public function show(Product $product)
    {
        return view('detail-products', compact('product'));
    }


    // logic untuk mengelola data penjualan, jumlah customer didashboard admin breeze
 public function indexDashboardAdmin()
{
    $totalSales = Checkout::where('status', 'sukses')->count();
    $revenue = Checkout::where('status', 'sukses')->sum('total_price');
    $pendingOrders = Checkout::where('status', 'pending')->count();
    $customers = User::where('role', 'customer')->count();

    // Ambil data sukses per tanggal
    $salesSuccess = Checkout::where('status', 'sukses')
        ->where('created_at', '>=', now()->subDays(30))
        ->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(total_price) as revenue')
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->keyBy('date');

    // Ambil data pending per tanggal
    $salesPending = Checkout::where('status', 'pending')
        ->where('created_at', '>=', now()->subDays(30))
        ->selectRaw('DATE(created_at) as date, COUNT(*) as pending')
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->keyBy('date');

    // Buat periode 30 hari terakhir
    $start = Carbon::parse('2025-07-01')->startOfDay(); // mulai bulan 7
    $end = Carbon::now()->endOfDay(); // sampai hari ini
    $period = CarbonPeriod::create($start, $end);
    
    // Siapkan data untuk grafik
    $labels = [];
    $sales = [];
    $revenueList = [];
    $pendingList = [];

    foreach ($period as $date) {
        $dateStr = $date->format('Y-m-d');
        $labels[] = $dateStr;
        $sales[] = $salesSuccess[$dateStr]->count ?? 0;
        $revenueList[] = $salesSuccess[$dateStr]->revenue ?? 0;
        $pendingList[] = $salesPending[$dateStr]->pending ?? 0;
    }

    $chartData = [
        'labels' => $labels,
        'sales' => $sales,
        'revenue' => $revenueList,
        'pending' => $pendingList
    ];

    return view('dashboard', compact(
        'totalSales',
        'revenue',
        'pendingOrders',
        'customers',
        'chartData'
    ));
}



   public function indexCustomer()
    {
        $customers = User::where('role', 'customer')
                    ->with(['latestCheckout' => function($query) {
                        $query->latest()->limit(1);
                    }])
                    ->paginate(10);
                    
        return view('customers.index', compact('customers'));
    }
}
