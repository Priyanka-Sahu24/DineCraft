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

    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <!-- ADD MENU -->
    <div class="card">
        <form action="<?php echo e(url('/menu/store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <label>Menu Name</label>
            <input type="text" name="name" required>

            <label>Price</label>
            <input type="number" step="0.01" name="price" required>

            <h3>Ingredients (Stock)</h3>

            <div id="ingredient-list">
                <div class="ingredient-row">
                    <select name="stock_id[]" required>
                        <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>">
                                <?php echo e($s->item_name); ?> (<?php echo e($s->quantity); ?> <?php echo e($s->unit); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($menu->name); ?></td>
                <td>₹<?php echo e($menu->price); ?></td>
                <td>
                    <?php $__currentLoopData = $menu->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($ing->item_name); ?>

                        - <?php echo e($ing->pivot->quantity_used); ?>

                        <?php echo e($ing->unit); ?> <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/menumanage.blade.php ENDPATH**/ ?>