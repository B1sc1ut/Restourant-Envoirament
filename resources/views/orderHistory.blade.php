@extends('layouts.app')

@section('title', 'Order History')

@section('content')
    <h1>Order History</h1>

    @forelse($orders as $orderGroup)
        @php
            $first = reset($orderGroup); // Get the first item in the group
        @endphp
        <div class="card mb-3">
            <div class="card-header">
                Order #{{ $first['id'] }} | Table: {{ $first['table_name'] }} | Date: {{ $first->created_at }}
            </div>
            <ul class="list-group list-group-flush">
                @foreach($orderGroup as $item)
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
