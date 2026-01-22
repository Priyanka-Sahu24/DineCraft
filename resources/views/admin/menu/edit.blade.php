@extends('layout')
@section('content')

<h2>Edit Menu Item</h2>

<form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ old('name', $menu->name) }}" required><br><br>

    <label for="category_id">Category:</label>
    <select name="category_id">
        @foreach($categories as $c)
            <option value="{{ $c->id }}" @if($c->id == $menu->category_id) selected @endif>{{ $c->name }}</option>
        @endforeach
    </select><br><br>

    <label for="price">Price:</label>
    <input type="number" name="price" value="{{ old('price', $menu->price) }}" required><br><br>

    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*"><br><br>
    @if($menu->image)
        <p>Current Image: <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="100"></p>
    @endif

    <h3>Ingredients</h3>

    @foreach($menu->ingredients as $ingredient)
        <div>
            <select name="stock_id[]">
                @foreach($stocks as $stock)
                    <option value="{{ $stock->id }}"
                        @if($stock->id == $ingredient->id) selected @endif>
                        {{ $stock->item_name }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="quantity_used[]" value="{{ $ingredient->pivot->qty_used }}" required>
            <br><br>
        </div>
    @endforeach

    <button type="submit">Update Menu</button>
</form>

@endsection
