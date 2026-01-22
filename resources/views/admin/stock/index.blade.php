@extends('layout')
@section('content')

<h2>Manage Stock</h2>

<form method="POST" action="/stock">
@csrf
<input name="item_name" placeholder="Item Name" required>
<input name="quantity" type="number" placeholder="Quantity" required>
<input name="unit" placeholder="Unit">
<button class="btn">Add Stock</button>
</form>

<table>
@foreach($stocks as $s)
<tr>
    <td>{{ $s->item_name }}</td>
    <td>{{ $s->quantity }}</td>
    <td>
        <a href="/stock/{{ $s->id }}/edit">Edit</a>
        <form method="POST" action="/stock/{{ $s->id }}" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>

@endsection
