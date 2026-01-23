@extends('customer.layout')

@section('content')
<h1>Menu</h1>
@foreach($menus as $menu)
    <div style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
        @if($menu->image && \Storage::disk('public')->exists($menu->image))
            <img src="/storage/{{ $menu->image }}" width="100" alt="{{ $menu->name }}">
        @endif
        <h3>{{ $menu->name }}</h3>
        <p>Price: ${{ $menu->price }}</p>
        <button onclick="addToCart({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }})">Add to Cart</button>
    </div>
@endforeach

<script>
    function addToCart(id, name, price) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let item = cart.find(i => i.id === id);
        if (item) {
            item.qty++;
        } else {
            cart.push({ id, name, price, qty: 1 });
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        alert('Added to cart');
    }
</script>
@endsection
