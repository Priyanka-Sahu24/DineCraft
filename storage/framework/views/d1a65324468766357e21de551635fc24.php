
<?php $__env->startSection('content'); ?>

<h2>Manage Menu</h2>

<form method="POST" action="/menu" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<input name="name" placeholder="Menu Name" required>
<select name="category_id">
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<h3>Ingredients</h3>
<div id="ingredient-list">
<div id="ingredient-row">
<select name="stock_id[]">
<?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($s->id); ?>"><?php echo e($s->item_name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<input name="quantity_used[]" type="number" placeholder="Qty Used" required>
</div>
</div>
<button type="button" onclick="addIngredientRow()">+ Add More Ingredient</button>

<input name="price" type="number" placeholder="Price" required>
<input type="file" name="image" accept="image/*">
<button class="btn">Add Menu</button>
</form>

<script>
function addIngredientRow(){
    let row = document.getElementById('ingredient-row');
    let clone = row.cloneNode(true);
    document.getElementById('ingredient-list').appendChild(clone);
}
</script>

<div class="table-container">
<table>
<tr>
    <th>Name</th>
    <th>Category</th>
    <th>Price</th>
    <th>Image</th>
    <th>Ingredients</th>
    <th>Actions</th>
</tr>
<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($m->name); ?></td>
    <td><?php echo e($m->category->name); ?></td>
    <td><?php echo e($m->price); ?></td>
    <td>
        <?php if($m->image): ?>
            <img src="<?php echo e(asset('storage/' . $m->image)); ?>" alt="<?php echo e($m->name); ?>" width="100">
        <?php else: ?>
            No Image
        <?php endif; ?>
    </td>
    <td>
        <?php $__currentLoopData = $m->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($ing->item_name); ?> (<?php echo e($ing->pivot->qty_used); ?>)<br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </td>
    <td>
        <a href="/menu/<?php echo e($m->id); ?>/edit">Edit</a>
        <form method="POST" action="/menu/<?php echo e($m->id); ?>" style="display:inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button class="btn">Delete</button>
        </form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/admin/menu/index.blade.php ENDPATH**/ ?>