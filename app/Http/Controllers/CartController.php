<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Logic CRUD data cart di cart page
    public function index()
    {
        $cart = auth()->user()->cart()->with('items.product')->firstOrCreate();
        return view('cart', compact('cart'));
    }

     public function addItem(Request $request, Product $product)
    {
        $quantity = 1; // Default quantity 1
    
        // Jika ingin tetap bisa menerima quantity dari request
        if($request->has('quantity')) {
            $request->validate([
                'quantity' => 'required|integer|min:1|max:'.$product->stock
            ]);
            $quantity = $request->quantity;
        }

        $cart = auth()->user()->cart()->firstOrCreate();
        
        $cartItem = $cart->items()->updateOrCreate(
            ['product_id' => $product->id],
            [
                'quantity' => $quantity, // Gunakan quantity baru, bukan increment
                'price' => $product->price
            ]
        );
        
        $cart->recalculateTotals();

        return redirect()->route('cart')->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function updateItem(Request $request, CartItem $item)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $item->update(['quantity' => $request->quantity]);
        $item->cart->recalculateTotals();

        return back()->with('success', 'Keranjang diperbarui');
    }

    public function removeItem(CartItem $item)
    {
        $item->delete();
        $item->cart->recalculateTotals();

        return back()->with('success', 'Produk dihapus dari keranjang');
    }
}
