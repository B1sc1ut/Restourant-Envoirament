<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_price',
        'product_img',
        'product_category',
        // add other fillable fields as needed
    ];

    public function names() {
        return $this->hasMany(ProductName::class, 'product_id');
    }

    public function allergens() {
        return $this->belongsToMany(Allergen::class, 'product_allergen');
    }
    
    public function translations()
    {
        return $this->hasMany(ProductName::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations()->where('locale', $locale)->first();
    }

    public function productName()
    {
        return $this->belongsTo(ProductName::class, 'product_name_id');
    }

    public function orders()
{
    return $this->belongsToMany(Order::class, 'order_product_link')
                ->withPivot('amount');
}
}
