@extends('layout')
@section('content')

<h2>Manage Menu</h2>

<form method="POST" action="/menu">
@csrf
<input name="name" placeholder="Menu Name" required>

<select name="category_id">
@foreach($categories as $c)
<option value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach
</select>

<select name="stock_id">
@foreach($stocks as $s)
<option value="{{ $s->id }}">{{ $s->item_name }}</option>
@endforeach
</select>

<input name="stock_used" type="number" placeholder="Stock Used" required>
<input name="price" type="number" placeholder="Price" required>

<button class="btn">Add Menu</button>
</form>

<table>
@foreach($menus as $m)
<tr>
    <td>{{ $m->name }}</td>
    <td>{{ $m->category->name }}</td>
    <td>{{ $m->price }}</td>
    <td>
        <a href="/menu/{{ $m->id }}/edit">Edit</a>
        <form method="POST" action="/menu/{{ $m->id }}" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>

@endsection
