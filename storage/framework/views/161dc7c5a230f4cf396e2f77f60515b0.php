

<?php $__env->startSection('content'); ?>
<h1>Menu</h1>
<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
        <?php if($menu->image && \Storage::disk('public')->exists($menu->image)): ?>
            <img src="/storage/<?php echo e($menu->image); ?>" width="100" alt="<?php echo e($menu->name); ?>">
        <?php endif; ?>
        <h3><?php echo e($menu->name); ?></h3>
        <p>Price: $<?php echo e($menu->price); ?></p>
        <button onclick="addToCart(<?php echo e($menu->id); ?>, '<?php echo e($menu->name); ?>', <?php echo e($menu->price); ?>)">Add to Cart</button>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script>
    function addToCart(id, name, price) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let item = cart.find(i => i.id === id);
        if (item) {
            item.qty++;
        } else {
            cart.push({ id, name, price, qty: 1 });
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        alert('Added to cart');
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('customer.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/customer/menu.blade.php ENDPATH**/ ?>