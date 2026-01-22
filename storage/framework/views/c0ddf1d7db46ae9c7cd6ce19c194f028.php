
<?php $__env->startSection('content'); ?>

<h2>Edit Menu Item</h2>

<form action="<?php echo e(route('menu.update', $menu->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo e(old('name', $menu->name)); ?>" required><br><br>

    <label for="category_id">Category:</label>
    <select name="category_id">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($c->id); ?>" <?php if($c->id == $menu->category_id): ?> selected <?php endif; ?>><?php echo e($c->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select><br><br>

    <label for="price">Price:</label>
    <input type="number" name="price" value="<?php echo e(old('price', $menu->price)); ?>" required><br><br>

    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*"><br><br>
    <?php if($menu->image): ?>
        <p>Current Image: <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>" width="100"></p>
    <?php endif; ?>

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

            <input type="number" name="quantity_used[]" value="<?php echo e($ingredient->pivot->qty_used); ?>" required>
            <br><br>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <button type="submit">Update Menu</button>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/admin/menu/edit.blade.php ENDPATH**/ ?>