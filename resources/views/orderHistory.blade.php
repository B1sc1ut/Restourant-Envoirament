@extends('layouts.app')

@section('title', 'Order History')

@section('content')
    <h1>Order History</h1>

    @forelse($orders as $orderId => $orderItems)
        <div class="card mb-3">
            <div class="card-header">
                Order #{{ $orderId }} | Table: {{ $orderItems->first()->table_number }} | Date: {{ $orderItems->first()->created_at }}
            </div>
            <ul class="list-group list-group-flush">
                @foreach($orderItems as $item)
                    <li class="list-group-item">
                        Product: {{ $item->product_name ?? 'Unnamed Product' }} | Amount: {{ $item->amount }}
                    </li>
                @endforeach
            </ul>
        </div>
    @empty
        <p>You have no past orders.</p>
    @endforelse
@endsection
