@extends('layout')
@section('content')

<style>
body{
    font-family: Arial;
    background:#f4f4f4;
}

.container{
    width:90%;
    margin:auto;
}

.card{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px #ddd;
}

h2{
    color:orange;
}

.btn{
    background:orange;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:5px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:10px;
    border:1px solid #ddd;
}
</style>

<script>
function addIngredientRow(){
    let row = document.getElementById('ingredient-row');
    let clone = row.cloneNode(true);
    document.getElementById('ingredient-list').appendChild(clone);
}
</script>

<div class="container">

<h2>🍽️ Manage Menu</h2>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<div class="card">

<form action="/menu/store" method="POST">
@csrf

<label>Menu Name:</label><br>
<input type="text" name="name" required><br><br>

<label>Price:</label><br>
<input type="number" step="0.01" name="price" required><br><br>

<h3>Ingredients</h3>

<div id="ingredient-list">

<div id="ingredient-row">
<select name="stock_id[]">
@foreach($stocks as $s)
<option value="{{ $s->id }}">{{ $s->item_name }} ({{ $s->quantity }} {{ $s->unit }})</option>
@endforeach
</select>

<input type="number" name="quantity_used[]" step="0.01" placeholder="Qty Used" required>
</div>

</div>

<br>
<button type="button" onclick="addIngredientRow()">+ Add More Ingredient</button>
<br><br>

<button class="btn" type="submit">Add Menu Item</button>

</form>
</div>

<br>

<h3>Menu List</h3>

<table>
<tr style="background:orange;color:white">
<th>Name</th>
<th>Price</th>
<th>Ingredients Used</th>
</tr>

@foreach($menus as $m)
<tr>
<td>{{ $m->name }}</td>
<td>₹{{ $m->price }}</td>
<td>
@foreach($m->ingredients as $ing)
{{ $ing->item_name }} - {{ $ing->pivot->quantity_used }} {{ $ing->unit }} <br>
@endforeach
</td>
</tr>
@endforeach

</table>

</div>

@endsection
