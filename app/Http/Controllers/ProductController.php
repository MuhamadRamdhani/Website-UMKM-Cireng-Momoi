<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   // Logic CRUD data produc di product page dashboard admin
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'price' => 'required|numeric|min:0|max:99999999.99',
        'stock' => 'required|integer',
        'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'price.max' => 'Harga yang Anda masukkan terlalu besar.',
            'price.numeric' => 'Harga harus berupa angka.',
            'stock.integer' => 'Stok harus berupa angka bulat.',
        ]);

        $product = Product::create($request->except(['thumbnail', 'images']));

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
            $product->update(['thumbnail' => $thumbnailPath]);
        }

        // Upload multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('products/images', 'public');
                $product->images()->create(['image_path' => $imagePath]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function gallery(Product $product)
    {
        return view('products.gallery', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update product data
        $product->update($request->except(['thumbnail', 'images']));

        // Update thumbnail if new one is uploaded
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            
            $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
            $product->update(['thumbnail' => $thumbnailPath]);
        }

        // Add new images if any
         if ($request->hasFile('images')) {
            // Hapus semua gambar terkait produk
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }

            // Tambahkan gambar baru
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/images', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         // Delete thumbnail
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        
        // Delete all product images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        
        // Delete product
        $product->delete();
        
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    // Untuk menghapus gambar individual
    public function deleteImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        
        return back()->with('success', 'Image deleted successfully');
    }
}
