<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Menu Item</title>
</head>
<body>

<h2>Add New Menu Item</h2>

<form action="{{ route('menu.store') }}" method="POST">
    @csrf

    <label for="name">Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="price">Price:</label>
    <input type="number" name="price" required><br><br>

    <h3>Ingredients</h3>
    @foreach($stocks as $stock)
        <div>
            <label>
                <input type="checkbox" name="stock_id[]" value="{{ $stock->id }}">
                {{ $stock->item_name }}
            </label>
            <input type="number" name="quantity_used[]" disabled>
            <br><br>
        </div>
    @endforeach

    <button type="submit">Add Menu</button>
</form>

</body>
</html>
