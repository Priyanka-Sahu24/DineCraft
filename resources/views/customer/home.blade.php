@extends('customer.layout')

@section('content')
<div class="hero">
	<div class="hero-inner" style="display:flex;align-items:center;justify-content:space-between;gap:18px;flex-wrap:wrap;">
		<div class="hero-text">
			<h1>Welcome to DineCraft</h1>
			<p class="lead">Experience culinary excellence with our diverse menu of fresh, delicious meals delivered right to your doorstep.</p>
			<a class="cta-btn" href="/customer/menu">Explore Our Menu</a>
		</div>
		<div class="hero-art">
			@php
				// Keep the same logo detection logic
				$logoCandidates = [
					'images/dinecraft-logo.png',
					'images/dinecraft-logo.png.png',
					'images/dinecraft-logo.PNG',
					'images/Logo design for Dine.png',
					'images/logo.png',
				];
				$logoFile = null;
				foreach ($logoCandidates as $c) {
					if (file_exists(public_path($c))) { $logoFile = $c; break; }
				}
				// Look for a nice background/hero image (user-uploaded)
				$bgCandidates = [
					'images/burger-bg.jpg',
					'images/burger-bg.png',
					'images/Realistic and appeti.png',
					'images/realistic-burger.png',
				];
				$bgFile = null;
				foreach ($bgCandidates as $b) {
					if (file_exists(public_path($b))) { $bgFile = $b; break; }
				}
			@endphp
			<div style="width:100%;height:100%;display:flex;justify-content:flex-end;align-items:center;">
				@php
					// compact card dimensions for tighter layout
					$cardStyle = "width:380px;height:200px;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,0.06);position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center;padding:12px;";
					if ($bgFile) {
						$bgUrl = asset(str_replace(' ', '%20', $bgFile));
						$cardStyle = "width:380px;height:200px;border-radius:12px;box-shadow:0 8px 20px rgba(0,0,0,0.06);position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center;padding:12px;background-image:linear-gradient(rgba(255,255,255,0.28), rgba(255,255,255,0.28)), url('".$bgUrl."');background-size:cover;background-position:center right;";
					}
				@endphp
				<div style="{{ $cardStyle }}">
					<!-- Logo (if present) positioned top-right in the card -->
						@if($logoFile)
							<img src="{{ asset($logoFile) }}" alt="DineCraft logo" style="position:absolute;right:12px;top:12px;width:96px;height:auto;border-radius:6px;box-shadow:0 6px 16px rgba(0,0,0,0.08);background:rgba(255,255,255,0.6);padding:6px;" />
						@endif
					<!-- removed background illustration to keep hero clean; show caption if no logo -->
					@if(!$logoFile)
						<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#f0803a;font-weight:700;font-family:Arial, sans-serif;font-size:18px;">
							Fresh &amp; Delicious
						</div>
					@endif
				</div>
			</div>
		</div>
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
		@foreach($popular as $item)
			<div class="food-card">
				@php $img = $item->image ?? null; @endphp
				@if($img && \Storage::disk('public')->exists($img))
					<img src="/storage/{{ $img }}" alt="{{ $item->name }}">
				@else
					<img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='400' height='240' viewBox='0 0 400 240'><rect width='100%' height='100%' fill='%23fff2e6' rx='8'/><text x='50%' y='50%' fill='%23e86c00' font-family='Arial' font-size='20' text-anchor='middle' alignment-baseline='middle'>{{ substr($item->name, 0, 10) }}</text></svg>" alt="placeholder">
				@endif
				<h4>{{ $item->name }}</h4>
				<p class="price">₹{{ $item->price }}</p>
				<a href="#" class="add-btn" onclick="alert('Add to cart not implemented in this demo')">Add to Cart</a>
			</div>
		@endforeach
	</div>
</div>

<div class="cta-section">
	<div class="cta-content">
		<h2>Ready to Order?</h2>
		<p>Browse our complete menu and place your order now.</p>
		<a href="/customer/menu" class="cta-btn-large">View Full Menu</a>
	</div>
</div>

@endsection