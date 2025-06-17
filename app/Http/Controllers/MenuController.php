<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function search(Request $request)
    {
        $categoryId = $request->input('category');
        $sort = $request->input('sort');

        $productsQuery = DB::table('products')
            ->leftJoin('product_names', function($join) {
                $join->on('products.id', '=', 'product_names.product_id')
                     ->where('product_names.locale', '=', 'en'); // Only English
            })
            ->select(
                'products.id',
                'products.product_img',
                'products.product_price',
                'products.product_category',
                'product_names.product_name',
                'product_names.product_description',
                'product_names.product_allergens'
            );

        if ($categoryId) {
            $productsQuery->where('product_category', $categoryId);
        }

        if ($sort === 'asc') {
            $productsQuery->orderBy('product_price', 'asc');
        } elseif ($sort === 'desc') {
            $productsQuery->orderBy('product_price', 'desc');
        }

        $products = $productsQuery->get();
        $categories = Category::all();

        return view('menu', compact('products', 'categories'));
    }
}