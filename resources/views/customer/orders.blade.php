@extends('customer.layout')

@section('content')
<h1>Your Orders</h1>
@if($orders->count() > 0)
    @foreach($orders as $order)
        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
            <p>Menu: {{ $order->menu->name }}</p>
            <p>Quantity: {{ $order->quantity }}</p>
            <p>Total: ${{ $order->total_price }}</p>
            <p>Status: {{ $order->status }}</p>
        </div>
    @endforeach
@else
    <p>No orders yet.</p>
@endif
@endsection