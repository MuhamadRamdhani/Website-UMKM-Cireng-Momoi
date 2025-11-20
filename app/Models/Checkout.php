<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'phone_number',
        'address',
        'payment_proof',
        'status',
        'total_price'
    ];


    // logic relasi dengan database lainnya
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

   public function cart()
    {
        return $this->belongsTo(Cart::class)->withDefault(); // Dengan fallback
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, CheckoutItem::class, 'checkout_id', 'id', 'id', 'product_id');
    }

    public function items()
    {
        return $this->hasMany(CheckoutItem::class);
    }

}
