@extends('layout')
@section('content')

<h2>Manage Categories</h2>

<form method="POST" action="/category">
@csrf
<input type="text" name="name" placeholder="Category Name" required>
<button class="btn">Add Category</button>
</form>

<table>
@foreach($categories as $c)
<tr>
    <td>{{ $c->name }}</td>
    <td>
        <a href="/category/{{ $c->id }}/edit">Edit</a>
        <form method="POST" action="/category/{{ $c->id }}" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>

@endsection
