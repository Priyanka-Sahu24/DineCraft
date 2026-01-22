@extends('layout')
@section('content')

<h2>Edit Category</h2>

<form method="POST" action="/category/{{ $category->id }}">
@csrf
@method('PUT')
<input type="text" name="name" value="{{ $category->name }}">
<button class="btn">Update</button>
</form>

@endsection
