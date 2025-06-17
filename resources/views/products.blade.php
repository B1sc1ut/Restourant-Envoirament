@extends('layouts.app')

@section('title', 'Products')

@section('content')
@php
    use App\Models\Product;
    use App\Models\ProductName;

    $locale = app()->getLocale(); // gets 'en', 'lv', etc.
    $product = isset($id) ? Product::find($id) : null;
    $product_name = isset($id) ? ProductName::where('product_id', $id)->where('locale', $locale)->first() : null;
@endphp

@if ($product)
    <h1>{{ $product_name->product_name }}</h1>
    <p><strong>Description:</strong> {{ $product_name->product_description }}</p>

    @if ($product_name->product_allergens)
        <p><strong>{{ __('product.allergens') }}</strong> {{ $product_name->product_allergens }}</p>
    @endif

    @if(!empty($product->product_img))
        <img 
            src="{{ asset('storage/' . ltrim($product->product_img, '/')) }}" 
            alt="Product Image" 
            style="max-width:200px;"
            onerror="this.style.display='none';"
        >
    @else
        <span>No image available.</span>
    @endif

    @if ($product->product_price)
        <p><strong>Price:</strong> {{ $product->product_price}}</p>
    @endif

    <form method="POST" action="{{ route('cart.add', ['id' => $product->id]) }}">
        @csrf
        <label for="amount">{{ __('product.amount') }}</label>
        <input type="number" name="amount" id="amount" value="1" min="1" required>
        <button type="submit">{{ __('product.add') }}</button>
    </form>
@else
    <p>{{ __('product.notFound') }}</p>
@endif
@endsection
