<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Welcome, Admin {{ session('name') }}</h2>

<p>This is the admin dashboard.</p>

<a href="{{ url('/logout') }}">Logout</a>

</body>
</html>
