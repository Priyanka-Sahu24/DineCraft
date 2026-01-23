<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - DineCraft</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
        }
        .menu-section {
            flex: 2;
            padding-right: 20px;
        }
        .cart-section {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
            height: fit-content;
        }
        .menu-item {
            background: white;
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
        }
        .menu-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }
        .menu-details {
            flex: 1;
        }
        .menu-details h3 {
            color: #ff7a00;
            margin-bottom: 10px;
        }
        .menu-details p {
            margin: 5px 0;
        }
        .price {
            font-weight: bold;
            color: #333;
        }
        .add-to-cart {
            background: #ff7a00;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .add-to-cart:hover {
            background: #e66a00;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item input {
            width: 50px;
        }
        .remove-btn {
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .buy-btn {
            background: green;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .buy-btn:hover {
            background: darkgreen;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover {
            color: black;
            cursor: pointer;
        }
        .modal form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .modal form button {
            width: 100%;
            padding: 10px;
            background: #ff7a00;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal form button:hover {
            background: #e66a00;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu-section">
            <h1>DineCraft Menu</h1>
            @foreach($menus as $menu)
                <div class="menu-item">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                    @endif
                    <div class="menu-details">
                        <h3>{{ $menu->name }}</h3>
                        <p><strong>Category:</strong> {{ $menu->category->name }}</p>
                        <p><strong>Ingredients:</strong> 
                            @foreach($menu->ingredients as $ing)
                                {{ $ing->item_name }} ({{ $ing->pivot->qty_used }}),
                            @endforeach
                        </p>
                        <p class="price">Price: ${{ $menu->price }}</p>
                        <button class="add-to-cart" onclick="addToCart({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }})">Add to Cart</button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="cart-section">
            <h2>Cart</h2>
            <div id="cart-items"></div>
            <p>Total: $<span id="total">0</span></p>
            <button class="buy-btn" onclick="buyNow()">Buy Now</button>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Customer Login</h2>
            <p>Please log in to place your order.</p>
            @if(session('error'))
                <p style="color:red">{{ session('error') }}</p>
            @endif
            <form method="POST" action="/customer/login">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="hidden" name="menu_id" id="menu_id">
                <button type="submit">Login & Order</button>
            </form>
            <p>Don't have an account? <a href="/register">Register</a></p>
        </div>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function addToCart(id, name, price) {
            let item = cart.find(i => i.id === id);
            if (item) {
                item.qty++;
            } else {
                cart.push({ id, name, price, qty: 1 });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCart();
        }

        function updateCart() {
            let cartItems = document.getElementById('cart-items');
            let total = 0;
            cartItems.innerHTML = '';
            cart.forEach((item, index) => {
                total += item.price * item.qty;
                cartItems.innerHTML += `
                    <div class="cart-item">
                        <span>${item.name}</span>
                        <input type="number" value="${item.qty}" min="1" onchange="changeQty(${index}, this.value)">
                        <span>$${item.price * item.qty}</span>
                        <button class="remove-btn" onclick="removeFromCart(${index})">Remove</button>
                    </div>
                `;
            });
            document.getElementById('total').textContent = total;
        }

        function changeQty(index, qty) {
            cart[index].qty = parseInt(qty);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCart();
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCart();
        }

        function buyNow() {
            if (cart.length === 0) {
                alert('Cart is empty');
                return;
            }
            // For now, show login modal
            document.getElementById('loginModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('loginModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('loginModal')) {
                closeModal();
            }
        }

        updateCart();
    </script>
</body>
</html>