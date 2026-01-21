@extends('layout')
@section('content')

<h2>Edit Menu</h2>

<form method="POST" action="/menu/{{ $menu->id }}">
@csrf
@method('PUT')
<input name="name" value="{{ $menu->name }}">
<input name="price" value="{{ $menu->price }}">
<button class="btn">Update</button>
</form>

@endsection
