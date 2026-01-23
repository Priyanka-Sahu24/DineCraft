

<?php $__env->startSection('content'); ?>
<h1>Your Cart</h1>
<div id="cart-items"></div>
<p>Total: $<span id="total">0</span></p>
<button onclick="checkout()">Checkout</button>

<script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let cartItems = document.getElementById('cart-items');
    let total = 0;
    cart.forEach((item, index) => {
        total += item.price * item.qty;
        cartItems.innerHTML += `
            <div>
                ${item.name} - Qty: <input type="number" value="${item.qty}" onchange="updateQty(${index}, this.value)"> - $${item.price * item.qty}
                <button onclick="remove(${index})">Remove</button>
            </div>
        `;
    });
    document.getElementById('total').textContent = total;

    function updateQty(index, qty) {
        cart[index].qty = parseInt(qty);
        localStorage.setItem('cart', JSON.stringify(cart));
        location.reload();
    }

    function remove(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        location.reload();
    }

    function checkout() {
        fetch('/customer/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({ cart: cart })
        }).then(response => {
            if (response.ok) {
                localStorage.removeItem('cart');
                window.location.href = '/customer/orders';
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/customer/cart.blade.php ENDPATH**/ ?>