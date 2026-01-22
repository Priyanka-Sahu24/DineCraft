@extends('layout')
@section('content')

<h2>Manage Menu</h2>

<form method="POST" action="/menu" enctype="multipart/form-data">
@csrf
<input name="name" placeholder="Menu Name" required>
<select name="category_id">
@foreach($categories as $c)
<option value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach
</select>

<h3>Ingredients</h3>
<div id="ingredient-list">
<div id="ingredient-row">
<select name="stock_id[]">
@foreach($stocks as $s)
<option value="{{ $s->id }}">{{ $s->item_name }}</option>
@endforeach
</select>
<input name="quantity_used[]" type="number" placeholder="Qty Used" required>
</div>
</div>
<button type="button" onclick="addIngredientRow()">+ Add More Ingredient</button>

<input name="price" type="number" placeholder="Price" required>
<input type="file" name="image" accept="image/*">
<button class="btn">Add Menu</button>
</form>

<script>
function addIngredientRow(){
    let row = document.getElementById('ingredient-row');
    let clone = row.cloneNode(true);
    document.getElementById('ingredient-list').appendChild(clone);
}
</script>

<div class="table-container">
<table>
<tr>
    <th>Name</th>
    <th>Category</th>
    <th>Price</th>
    <th>Image</th>
    <th>Ingredients</th>
    <th>Actions</th>
</tr>
@foreach($menus as $m)
<tr>
    <td>{{ $m->name }}</td>
    <td>{{ $m->category->name }}</td>
    <td>{{ $m->price }}</td>
    <td>
        @if($m->image)
            <img src="{{ asset('storage/' . $m->image) }}" alt="{{ $m->name }}" width="100">
        @else
            No Image
        @endif
    </td>
    <td>
        @foreach($m->ingredients as $ing)
            {{ $ing->item_name }} ({{ $ing->pivot->qty_used }})<br>
        @endforeach
    </td>
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
</div>

@endsection
