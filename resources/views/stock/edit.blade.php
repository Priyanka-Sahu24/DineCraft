@extends('layout')
@section('content')

<h2>Edit Stock</h2>

<form method="POST" action="/stock/{{ $stock->id }}">
@csrf
@method('PUT')
<input name="item_name" value="{{ $stock->item_name }}">
<input name="quantity" type="number" value="{{ $stock->quantity }}">
<input name="unit" value="{{ $stock->unit }}">
<button class="btn">Update</button>
</form>

@endsection
