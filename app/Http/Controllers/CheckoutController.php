<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\CheckoutItem;

class CheckoutController extends Controller
{
    const SHIPPING_COST = 15000; // Constant for shipping cost

    // Logic CRUD data checkout di checkout page
    public function index()
    {
        $user = Auth::user();

        // Ambil cart milik user yang login beserta item dan produk
        $cart = Cart::with('items.product')->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        // Hitung subtotal dari item
        $subtotal = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $total = $subtotal + self::SHIPPING_COST;

        return view('checkout', [
            'cartItems' => $cart->items,
            'subtotal' => $subtotal,
            'total' => $total,
            'shippingCost' => self::SHIPPING_COST
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'address' => 'required',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // Ambil cart user yang sedang login
        $cart = Cart::with('items.product')->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung total harga
        $subtotal = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $totalPrice = $subtotal + self::SHIPPING_COST;

        // Simpan bukti pembayaran
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Buat record checkout
        $checkout = Checkout::create([
            'user_id' => $user->id,
            'order_id' => 'ORD-' . strtoupper(uniqid()),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'payment_proof' => $path,
            'status' => 'pending',
            'subtotal' => $subtotal,
            'shipping_cost' => self::SHIPPING_COST,
            'total_price' => $totalPrice,
        ]);

        // Pindahkan item dari cart ke checkout_items
        foreach ($cart->items as $item) {
            // Kurangi stok produk
            $product = $item->product;
            if ($product->stock < $item->quantity) {
                $checkout->delete(); // rollback jika gagal
                return redirect()->back()->with('error', 'Stok produk ' . $product->name . ' tidak mencukupi.');
            }

            // Buat item checkout
            CheckoutItem::create([
                'checkout_id' => $checkout->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);

            // Kurangi stok
            $product->stock -= $item->quantity;
            $product->save();
        }

        // Hapus cart dan itemnya
        $cart->items()->delete();
        $cart->delete();

        return redirect()->route('checkout.success')->with('success', 'Checkout berhasil!');
    }

    // Logic untuk menampilkan data transaksi di dashboard admin
    public function indexTransaction()
    {
        $checkouts = Checkout::with(['user', 'items.product'])->latest()->paginate(10);
        return view('transactions.index', compact('checkouts'));
    }

    public function updateStatus(Request $request, Checkout $checkout)
    {
        $request->validate([
            'status' => 'required|in:pending,sukses,gagal'
        ]);

        $checkout->update(['status' => $request->status]);

        // Jika status diubah ke gagal, kembalikan stok produk
        if ($request->status === 'gagal') {
            foreach ($checkout->items as $item) {
                $product = $item->product;
                $product->stock += $item->quantity;
                $product->save();
            }
        }

        return back()->with('success', 'Status berhasil diperbarui');
    }
}