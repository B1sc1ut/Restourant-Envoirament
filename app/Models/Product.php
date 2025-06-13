<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function names() {
        return $this->hasMany(ProductName::class, 'product_id');
    }

    public function allergens() {
        return $this->belongsToMany(Allergen::class, 'product_allergen');
    }

}
