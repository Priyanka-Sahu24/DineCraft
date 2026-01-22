<!DOCTYPE html>
<html>
<head>
    <title>Dinecraft Restaurant Management</title>
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="sidebar">
    <h2>Dinecraft</h2>
    <a href="/admin/dashboard">Dashboard</a>
    <a href="/menu">Manage Menu</a>
    <a href="/category">Manage Categories</a>
    <a href="/stock">Manage Stock Items</a>
    <a href="/staff">Manage Staff</a>
    <a href="/orders">Orders</a>
    <a href="/payments">Payments</a>
    <a href="/reservations">Table Reservation</a>
</div>

<div class="main">
    @yield('content')
</div>

</body>
</html>
