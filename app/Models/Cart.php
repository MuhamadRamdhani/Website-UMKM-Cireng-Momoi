<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'total_quantity',
    ];


    // logic relasi dengan database lainnya
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Hitung ulang total cart
    public function recalculateTotals()
    {
        $this->total_price = $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        
        $this->total_quantity = $this->items->sum('quantity');
        $this->save();
    }

    
}
