@extends('layouts.app')

@section('title', 'All Orders')

@section('content')
<h1>All Active Orders</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(count($orders))
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Table</th>
                <th>Created At</th>
                <th>Items</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->table_name }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ ucfirst($order->status ?? '') }}</td> <!-- Safely access status -->
                <td>
                    <a href="{{ route('order.details', $order->id) }}" class="btn btn-info">Show Order</a>
                </td>
                <td>
                    @if(auth()->user()->role === 'chef')
                        <form method="POST" action="{{ route('orders.status.update', $order->id) }}">
                            @csrf
                            <select name="status" class="form-select" style="width:auto; display:inline;">
                                <option value="cooking" {{ ($order->status ?? '') == 'cooking' ? 'selected' : '' }}>Cooking</option>
                                <option value="cooked" {{ ($order->status ?? '') == 'cooked' ? 'selected' : '' }}>Cooked</option>
                                <option value="finished" {{ ($order->status ?? '') == 'finished' ? 'selected' : '' }}>Finished</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </form>
                    @else
                    
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('orders.fulfill', $order->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success">Order Fullfilled</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>No active orders.</p>
@endif
@endsection
