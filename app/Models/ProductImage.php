<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image_path'];


    // logic relasi dengan database lainnya
    public function product()
        {
            return $this->belongsTo(Product::class);
        }
}
