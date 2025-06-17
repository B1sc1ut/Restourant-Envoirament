@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <h1>Order #{{ $orderId }} Details</h1>
    
    @if(count($items))
        <ul class="list-unstyled">
            @foreach($items as $item)
                <li>{{ $item->product_name }} (x{{ $item->amount }})</li>
            @endforeach
        </ul>
    @else
        <p>No items found for this order.</p>
    @endif

    <a href="{{ route('tables.view') }}" class="btn btn-primary">Back to Orders</a>
</div>
@endsection