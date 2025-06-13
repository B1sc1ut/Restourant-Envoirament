<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function table() {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'order_product_link')->withPivot('amount');
    }

}
