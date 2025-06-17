<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductName extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'product_description',
        'locale',
        // add other fillable fields as needed
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
