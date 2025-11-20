<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
 use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', [UserController::class, 'index'])->name('welcome');
Route::get('/details/{product}', [UserController::class, 'show'])->name('detail.products');

// Route untuk login ke dashboard admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
   Route::get('/dashboard', [UserController::class, 'indexDashboardAdmin'])->name('dashboard');
   
    //Route crud product di dashboard admin
    Route::resource('products', ProductController::class);
    Route::get('products/{product}/gallery', [ProductController::class, 'gallery'])
        ->name('products.gallery');
    Route::delete('products/images/{image}', [ProductController::class, 'deleteImage'])
        ->name('products.deleteImage');

    // Route nampilin data customer di dashboard admin
    Route::get('/customers', [userController::class, 'indexCustomer'])->name('customers.index');

    // Route nampilin data transaksi di dashboard admin
    Route::get('/checkouts', [CheckoutController::class, 'indexTransaction'])->name('transactions.index');
    Route::put('/checkouts/{checkout}/status', [CheckoutController::class, 'updateStatus'])->name('transactions.update-status');

    // Route untuk cetak laporan transaksi
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetakPdf'])->name('laporan.cetak');

});

// Route untuk login dan register customer
Route::middleware(['auth', RoleMiddleware::class . ':customer'])->group(function () {
    // Route nampilin data cart dan proses di cart page customer
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [CartController::class, 'addItem'])->name('cart.add');
    Route::put('/cart/update/{item}', [CartController::class, 'updateItem'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'removeItem'])->name('cart.remove');

    // Route nampilin data checkout dan proses checkout di checkout page customer
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::view('/checkout/success', 'checkout-success')->name('checkout.success');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
