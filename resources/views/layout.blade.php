<!DOCTYPE html>
<html>
<head>
    <title>Dinecraft Restaurant Management</title>
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="sidebar">
    <h2>Dinecraft</h2>
    <a href="/menu">Manage Menu</a>
    <a href="/category">Manage Category</a>
    <a href="/stock">Manage Stock</a>
</div>

<div class="main">
    @yield('content')
</div>

</body>
</html>
