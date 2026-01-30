
<?php $__env->startSection('content'); ?>

<h2>Admin Dashboard</h2>

<div class="stats">
    <div class="stat-card">
        <p>Total Menus</p>
        <h3><?php echo e($totalMenus); ?></h3>
    </div>
    <div class="stat-card">
        <p>Total Categories</p>
        <h3><?php echo e($totalCategories); ?></h3>
    </div>
    <div class="stat-card">
        <p>Total Stock Items</p>
        <h3><?php echo e($totalStocks); ?></h3>
    </div>
    <div class="stat-card">
        <p>Total Staff</p>
        <h3><?php echo e($totalStaff); ?></h3>
    </div>
    <div class="stat-card">
        <p>Total Revenue</p>
        <h3>₹ <?php echo e(number_format($totalRevenue, 2)); ?></h3>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>