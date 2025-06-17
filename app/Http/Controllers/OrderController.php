<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderController extends Controller
{
    public function orderHistory()
    {
        $userId = Auth::id();

        $orders = DB::table('orders')
        ->where('orders.user_id', $userId)
        ->join('tables', 'orders.table_id', '=', 'tables.id')
        ->leftJoin('order_product_link', 'orders.id', '=', 'order_product_link.order_id')
        ->leftJoin('products', 'order_product_link.product_id', '=', 'products.id')
        ->leftJoin('product_names', function($join) {
            $join->on('products.id', '=', 'product_names.product_id')
                 ->where('product_names.locale', '=', $locale);
        })
        ->select(
            'orders.id as order_id',
            'tables.table_number',
            'product_names.product_name',
            'order_product_link.amount',
            'orders.created_at'
        )
        ->orderBy('orders.created_at', 'desc')
        ->get()
        ->groupBy('order_id'); // Group by order for display

    return view('orderHistory', compact('orders'));
    }
}
