<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\User;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month ?? now()->format('Y-m'); // format: 2025-07

        $checkouts = Checkout::where('status', 'sukses')
            ->whereYear('created_at', substr($month, 0, 4))
            ->whereMonth('created_at', substr($month, 5, 2))
            ->get();

        $totalSales = $checkouts->count();
        $revenue = $checkouts->sum('total_price');
        $pendingOrders = Checkout::where('status', 'pending')->count();
        $customers = User::where('role', 'customer')->count();

        // Grafik data per tanggal
        $sales = $checkouts->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        });

        $labels = [];
        $salesCount = [];
        $revenueList = [];

        foreach ($sales as $date => $items) {
            $labels[] = $date;
            $salesCount[] = $items->count();
            $revenueList[] = $items->sum('total_price');
        }

        $pendingPerDate = Checkout::where('status', 'pending')
            ->whereYear('created_at', substr($month, 0, 4))
            ->whereMonth('created_at', substr($month, 5, 2))
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            });

        $pendingList = [];
        foreach ($labels as $date) {
            $pendingList[] = $pendingPerDate[$date]->count() ?? 0;
        }

        $chartData = [
            'labels' => $labels,
            'sales' => $salesCount,
            'revenue' => $revenueList,
            'pending' => $pendingList,
        ];

        return view('laporan.index', compact('totalSales', 'revenue', 'pendingOrders', 'customers', 'chartData'));
    }

    public function cetakPdf(Request $request)
    {
        $month = $request->month ?? now()->format('Y-m');

        $checkouts = Checkout::with('user')
            ->where('status', 'sukses')
            ->whereYear('created_at', substr($month, 0, 4))
            ->whereMonth('created_at', substr($month, 5, 2))
            ->get();

        $totalRevenue = $checkouts->sum('total_price');

        $pdf = PDF::loadView('laporan.pdf', compact('checkouts', 'month', 'totalRevenue'));
        return $pdf->stream('laporan-penjualan-'.$month.'.pdf');
    }
}
