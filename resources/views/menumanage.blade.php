<!DOCTYPE html>
<html>
<head>
    <title>Manage Menu</title>

    <style>
        body{
            font-family: Arial, sans-serif;
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
        h2,h3{
            color:orange;
        }
        input, select{
            padding:8px;
            width:100%;
            margin-bottom:10px;
        }
        .btn{
            background:orange;
            color:white;
            border:none;
            padding:8px 15px;
            border-radius:5px;
            cursor:pointer;
        }
        table{
            width:100%;
            border-collapse:collapse;
            background:white;
        }
        th,td{
            padding:10px;
            border:1px solid #ddd;
            text-align:left;
        }
        th{
            background:orange;
            color:white;
        }
        .ingredient-row{
            display:flex;
            gap:10px;
            margin-bottom:10px;
        }
    </style>

    <script>
        function addIngredientRow(){
            let row = document.querySelector('.ingredient-row');
            let clone = row.cloneNode(true);
            clone.querySelectorAll('input').forEach(i => i.value = '');
            document.getElementById('ingredient-list').appendChild(clone);
        }
    </script>
</head>

<body>

<div class="container">

    <h2>🍽️ Manage Menu</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <!-- ADD MENU -->
    <div class="card">
        <form action="{{ url('/menu/store') }}" method="POST">
            @csrf

            <label>Menu Name</label>
            <input type="text" name="name" required>

            <label>Price</label>
            <input type="number" step="0.01" name="price" required>

            <h3>Ingredients (Stock)</h3>

            <div id="ingredient-list">
                <div class="ingredient-row">
                    <select name="stock_id[]" required>
                        @foreach($stocks as $s)
                            <option value="{{ $s->id }}">
                                {{ $s->item_name }} ({{ $s->quantity }} {{ $s->unit }})
                            </option>
                        @endforeach
                    </select>

                    <input type="number" step="0.01" name="quantity_used[]" placeholder="Qty Used" required>
                </div>
            </div>

            <button type="button" class="btn" onclick="addIngredientRow()">+ Add Ingredient</button>
            <br><br>

            <button type="submit" class="btn">Save Menu</button>
        </form>
    </div>

    <br>

    <!-- MENU LIST -->
    <h3>Menu Items</h3>

    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Ingredients Used</th>
        </tr>

        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>₹{{ $menu->price }}</td>
                <td>
                    @foreach($menu->ingredients as $ing)
                        {{ $ing->item_name }}
                        - {{ $ing->pivot->quantity_used }}
                        {{ $ing->unit }} <br>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>

</div>

</body>
</html>
