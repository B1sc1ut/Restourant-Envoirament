@extends('layouts.app')

@section('title', 'Create Menu Item')

@section('content')
<div class="container">
    <h1>Create Menu Item</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('menuitem.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="product_name_en" class="form-label">Product Name (EN)</label>
            <input type="text" class="form-control" id="product_name_en" name="product_name_en" required>
        </div>
        <div class="mb-3">
            <label for="product_description_en" class="form-label">Description (EN)</label>
            <textarea class="form-control" id="product_description_en" name="product_description_en"></textarea>
        </div>
        <div class="mb-3">
            <label for="product_name_lv" class="form-label">Product Name (LV)</label>
            <input type="text" class="form-control" id="product_name_lv" name="product_name_lv">
        </div>
        <div class="mb-3">
            <label for="product_description_lv" class="form-label">Description (LV)</label>
            <textarea class="form-control" id="product_description_lv" name="product_description_lv"></textarea>
        </div>
        <div class="mb-3">
            <label for="product_price" class="form-label">Price (€)</label>
            <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" required>
        </div>
        <div class="mb-3">
            <label for="product_img" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="product_img" name="product_img" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="product_category" class="form-label">Category</label>
            <select class="form-control" id="product_category" name="product_category" required>
                <option value="">Select Category</option>
                @if(isset($categories) && count($categories) > 0)
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name ?? $cat->name }}</option>
                    @endforeach
                @else
                    <option value="">No categories available</option>
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Menu Item</button>
    </form>

    @if(!empty($product->product_img))
        <div class="mt-3">
            <h2>Uploaded Image:</h2>
            <img src="{{ asset('storage/' . $product->product_img) }}" alt="Product Image" style="max-width:200px;">
        </div>
    @endif
</div>
@endsection

<?php
use Illuminate\Http\Request;

Route::post('/menu-item/store', function (Request $request) {
    $request->validate([
        // ... other validation ...
        'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imgPath = null;
    if ($request->hasFile('product_img')) {
        // Save to 'img' folder in storage/app/public
        $imgPath = $request->file('product_img')->store('img', 'public');
    }

    $product = Product::create([
        // ... other fields ...
        'product_img' => $imgPath,
    ]);

    // ... rest of your logic ...
});