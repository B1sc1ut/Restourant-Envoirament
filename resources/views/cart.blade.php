@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<h1>Your Cart</h1>

@if(count($products))
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Amount</th>
                <th>Price (each)</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['amount'] }}</td>
                    <td>€{{ number_format($item['price'], 2) }}</td>
                    <td>€{{ number_format($item['total'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>
        <strong>Grand Total: €{{ number_format(collect($products)->sum('total'), 2) }}</strong>
    </p>

    <form method="POST" action="{{ route('cart.pay') }}">
        @csrf
        @php
            $tables = \App\Models\Table::all();
        @endphp
        <label for="table_number">Table:</label>
        <select name="table_number" id="table_number" required>
            @foreach($tables as $table)
                <option value="{{ $table->id }}">Table {{ $table->id }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success">Pay</button>
    </form>
@else
    <p>Your cart is empty.</p>
@endif
@endsection