@extends('layout')
@section('content')

<h2>Admin Dashboard</h2>

<div class="stats">
    <div class="stat-card">
        <p>Total Menus</p>
        <h3>{{ $totalMenus }}</h3>
    </div>
    <div class="stat-card">
        <p>Total Categories</p>
        <h3>{{ $totalCategories }}</h3>
    </div>
    <div class="stat-card">
        <p>Total Stock Items</p>
        <h3>{{ $totalStocks }}</h3>
    </div>
    <div class="stat-card">
        <p>Total Staff</p>
        <h3>{{ $totalStaff }}</h3>
    </div>
    <div class="stat-card">
        <p>Total Revenue</p>
        <h3>₹ {{ number_format($totalRevenue, 2) }}</h3>
    </div>
</div>

@endsection
