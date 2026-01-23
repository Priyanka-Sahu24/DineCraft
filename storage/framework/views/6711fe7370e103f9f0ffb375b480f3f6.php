

<?php $__env->startSection('content'); ?>
<div class="hero">
	<div class="hero-inner">
		<div class="hero-text">
			<h1>Welcome to DineCraft</h1>
			<p class="lead">Experience culinary excellence with our diverse menu of fresh, delicious meals delivered right to your doorstep.</p>
			<a class="cta-btn" href="/customer/menu">Explore Our Menu</a>
		</div>
		<div class="hero-art">
			<!-- Enhanced SVG illustration -->
			<img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='600' height='360' viewBox='0 0 600 360'><defs><linearGradient id='g' x1='0' x2='1'><stop offset='0' stop-color='%23ffd7b3'/><stop offset='1' stop-color='%23ff8a2b'/></linearGradient><linearGradient id='g2' x1='0' y1='0' x2='0' y2='1'><stop offset='0' stop-color='%23fff'/><stop offset='1' stop-color='%23f0f0f0'/></linearGradient></defs><rect width='100%' height='100%' fill='url(%23g)' rx='20'/><g transform='translate(40,40)'><ellipse cx='340' cy='160' rx='130' ry='80' fill='%23fff3e6' opacity='0.6'/><g transform='translate(250,60)'><rect x='0' y='60' width='170' height='90' rx='16' fill='%23f4b183'/><circle cx='20' cy='30' r='28' fill='%23f9d07c'/><rect x='-40' y='10' width='120' height='80' rx='12' fill='%23ffd9b1'/></g><text x='50%' y='320' fill='%23fff' font-family='Arial' font-size='14' text-anchor='middle'>Fresh & Delicious</text></g></svg>" alt="hero-art" style="width:100%;height:100%;object-fit:contain;border-radius:12px" />
		</div>
	</div>
</div>

<div class="features-section">
	<div class="features-grid">
		<div class="feature-card">
			<div class="feature-icon">🚚</div>
			<h3>Fast Delivery</h3>
			<p>Get your food delivered hot and fresh within 30 minutes.</p>
		</div>
		<div class="feature-card">
			<div class="feature-icon">🍽️</div>
			<h3>Quality Ingredients</h3>
			<p>We use only the finest, freshest ingredients in every dish.</p>
		</div>
		<div class="feature-card">
			<div class="feature-icon">⭐</div>
			<h3>Best Reviews</h3>
			<p>Join thousands of satisfied customers who love our service.</p>
		</div>
	</div>
</div>

<div class="popular-section">
	<h2>Popular Dishes</h2>
	<p class="section-subtitle">Discover our most loved meals</p>
	<div class="popular-grid">
		<?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="food-card">
				<?php $img = $item->image ?? null; ?>
				<?php if($img && \Storage::disk('public')->exists($img)): ?>
					<img src="/storage/<?php echo e($img); ?>" alt="<?php echo e($item->name); ?>">
				<?php else: ?>
					<img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='400' height='240' viewBox='0 0 400 240'><rect width='100%' height='100%' fill='%23fff2e6' rx='8'/><text x='50%' y='50%' fill='%23e86c00' font-family='Arial' font-size='20' text-anchor='middle' alignment-baseline='middle'><?php echo e(substr($item->name, 0, 10)); ?></text></svg>" alt="placeholder">
				<?php endif; ?>
				<h4><?php echo e($item->name); ?></h4>
				<p class="price">₹<?php echo e($item->price); ?></p>
				<a href="#" class="add-btn" onclick="alert('Add to cart not implemented in this demo')">Add to Cart</a>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>

<div class="cta-section">
	<div class="cta-content">
		<h2>Ready to Order?</h2>
		<p>Browse our complete menu and place your order now.</p>
		<a href="/customer/menu" class="cta-btn-large">View Full Menu</a>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/customer/home.blade.php ENDPATH**/ ?>