<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu Item</title>
</head>
<body>

<h2>Edit Menu Item</h2>

<form action="<?php echo e(route('menu.update', $menu->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>  <!-- Use PUT to update the resource -->

    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo e(old('name', $menu->name)); ?>" required><br><br>

    <label for="price">Price:</label>
    <input type="number" name="price" value="<?php echo e(old('price', $menu->price)); ?>" required><br><br>

    <h3>Ingredients</h3>

    <?php $__currentLoopData = $menu->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <select name="stock_id[]">
                <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($stock->id); ?>" 
                        <?php if($stock->id == $ingredient->id): ?> selected <?php endif; ?>>
                        <?php echo e($stock->item_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <input type="number" name="quantity_used[]" value="<?php echo e($ingredient->pivot->quantity_used); ?>" required>
            <br><br>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <button type="submit">Update Menu</button>
</form>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/menu_edit.blade.php ENDPATH**/ ?>