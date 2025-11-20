<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name', 
    'description', 
    'price', 
    'stock',
    'thumbnail'
    ];


    // logic relasi dengan database lainnya
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    
}
