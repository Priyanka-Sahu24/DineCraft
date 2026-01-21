<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu Item</title>
</head>
<body>

<h2>Edit Menu Item</h2>

<form action="{{ route('menu.update', $menu->id) }}" method="POST">
    @csrf
    @method('PUT')  <!-- Use PUT to update the resource -->

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ old('name', $menu->name) }}" required><br><br>

    <label for="price">Price:</label>
    <input type="number" name="price" value="{{ old('price', $menu->price) }}" required><br><br>

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

            <input type="number" name="quantity_used[]" value="{{ $ingredient->pivot->quantity_used }}" required>
            <br><br>
        </div>
    @endforeach

    <button type="submit">Update Menu</button>
</form>

</body>
</html>
