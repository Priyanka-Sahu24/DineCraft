@extends('layout')
@section('content')

<div class="container">
    <h2>Menu List</h2>

    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Ingredients</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @foreach($menus as $menu)
        <tr>
            <td>{{ $menu->name }}</td>
            <td>₹{{ $menu->price }}</td>
            <td>
                @foreach($menu->ingredients as $ingredient)
                    {{ $ingredient->item_name }} ({{ $ingredient->pivot->quantity_used }})<br>
                @endforeach
            </td>
            <td>
                <span>{{ $menu->available ? 'Available' : 'Out of Stock' }}</span>
            </td>
            <td>
                <a href="{{ route('menu.edit', $menu->id) }}">✏️ Edit</a>

                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this menu item?')">🗑 Delete</button>
                </form>

                <form action="{{ route('menu.toggleAvailability', $menu->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">{{ $menu->available ? 'Mark as Out of Stock' : 'Mark as Available' }}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
