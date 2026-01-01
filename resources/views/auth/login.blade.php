<!DOCTYPE html>
<html>
<head>
    <title>Dinecraft Login</title>
</head>
<body>

<h2>Dinecraft Restaurant Login</h2>

<form action="{{ url('/login') }}" method="POST">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

</body>
</html>
