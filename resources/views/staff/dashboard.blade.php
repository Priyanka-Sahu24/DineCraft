<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard</title>
</head>
<body>

<h2>Welcome, Staff {{ session('name') }}</h2>

<p>This is the staff dashboard.</p>

<a href="{{ url('/logout') }}">Logout</a>

</body>
</html>
