@extends('layouts.app')

@section('title', 'Menu')

@section('content')

<h1>{{ __('menu.title') }}</h1>

<form id="menuSearchForm" method="GET" action="{{ url('/menu') }}">
    <label for="category">{{ __('menu.category') }}</label>
    <select name="category" id="category">
        <option value="">{{ __('menu.all') }}</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                {{ $cat->category_name ?? $cat->name }}
            </option>
        @endforeach
    </select>

    <label for="sort">{{ __('menu.sort') }}</label>
    <select name="sort" id="sort">
        <option value="">{{ __('menu.none') }}</option>
        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>{{ __('menu.low') }}</option>
        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>{{ __('menu.high') }}</option>
    </select>

    <button type="submit">{{ __('menu.search') }}</button>
</form>

<hr>

<div id="productsContainer">
    @forelse ($products as $product)
        <a href="{{ route('product.show', ['id' => $product->id]) }}" style="text-decoration:none; color:inherit;">
            <div class="product">
                <h2>{{ $product->product_name ?? 'Unnamed Product' }}</h2>
                <p><strong>Description:</strong> {{ $product->product_description ?? 'N/A' }}</p>
                <p><strong>Price:</strong> €{{ number_format($product->product_price, 2) }}</p>
                <p><strong>Allergens:</strong> {{ $product->product_allergens ?? 'None' }}</p>
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
            </div>
        </a>
    @empty
        <p>No products found.</p>
    @endforelse
</div>

<?php
$product = isset($id) ? Product::find($id) : null;
$product_name = isset($id) ? ProductName::find($id) : null;
?>

@if($product_name)
    <h1>{{ $product_name->product_name }}</h1>
    <p>{{ $product_name->product_description }}</p>
@else
    <h1>Unnamed Product</h1>
    <p>No description available.</p>
@endif

@endsection