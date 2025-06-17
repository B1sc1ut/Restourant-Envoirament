<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Info</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        img { max-width: 300px; height: auto; margin-top: 15px; }
    </style>
</head>
<body>

@php
    use App\Models\Product;
    use App\Models\ProductName;

    $product = isset($id) ? Product::find($id) : null;
    $product_name = isset($id) ? ProductName::where('product_id', $id)->first() : null;
@endphp

@if ($product)
    <h1>{{ $product_name->product_name }}</h1>
    <p><strong>Description:</strong> {{ $product_name->product_description }}</p>

    @if ($product_name->product_allergens)
        <p><strong>Allergens:</strong> {{ $product_name->product_allergens }}</p>
    @endif

    @if ($product->product_img)
        <img src="{{ asset('storage/public/img' . $product->product_img) }}" alt="Product Image">
    @endif

    @if ($product->product_price)
        <p><strong>Price:</strong> {{ $product->product_price}}</p>
    @endif

    <form method="POST" action="{{ route('cart.add', ['id' => $product->id]) }}">
        @csrf
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" value="1" min="1" required>
        <button type="submit">Add to Cart</button>
    </form>
@else
    <p>❌ Product not found.</p>
@endif
