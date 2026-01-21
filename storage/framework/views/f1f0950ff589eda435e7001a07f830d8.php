<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Menu</title>
    <style>
        /* Your styles go here */
    </style>
</head>
<body>

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

        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($menu->name); ?></td>
            <td>₹<?php echo e($menu->price); ?></td>
            <td>
                <?php $__currentLoopData = $menu->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($ingredient->item_name); ?> (<?php echo e($ingredient->pivot->quantity_used); ?>)<br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td>
                <span><?php echo e($menu->available ? 'Available' : 'Out of Stock'); ?></span>
            </td>
            <td>
                <a href="<?php echo e(route('menu.edit', $menu->id)); ?>">✏️ Edit</a>

                <form action="<?php echo e(route('menu.destroy', $menu->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this menu item?')">🗑 Delete</button>
                </form>

                <form action="<?php echo e(route('menu.toggleAvailability', $menu->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit"><?php echo e($menu->available ? 'Mark as Out of Stock' : 'Mark as Available'); ?></button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/menumanage.blade.php ENDPATH**/ ?>