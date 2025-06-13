<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    public function translations() {
        return $this->hasMany(AllergenTranslation::class, 'allergen_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_allergen');
    }
}
