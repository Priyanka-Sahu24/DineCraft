

<?php $__env->startSection('content'); ?>
<h1>Your Orders</h1>
<?php if($orders->count() > 0): ?>
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px;">
            <p>Menu: <?php echo e($order->menu->name); ?></p>
            <p>Quantity: <?php echo e($order->quantity); ?></p>
            <p>Total: $<?php echo e($order->total_price); ?></p>
            <p>Status: <?php echo e($order->status); ?></p>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <p>No orders yet.</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/customer/orders.blade.php ENDPATH**/ ?>