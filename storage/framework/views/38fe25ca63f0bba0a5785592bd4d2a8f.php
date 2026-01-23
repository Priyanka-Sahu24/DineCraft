<!DOCTYPE html>
<html>
<head>
    <title>DineCraft Customer Login</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    background: #ff7a00;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

h2 {
    margin-top: 90px;
    font-size: 48px;
    font-weight: 700;
    color: #ffffff;
}

h6 {
    margin-top: 20px;
    font-size: 16px;
    font-weight: 600;
    color: #ffffff;
    letter-spacing: 0.6px;
}

p.outset {
    margin-top: 45px;
    margin-bottom: 65px;
    background: #ff9a3c;
    color: #ffffff;
    font-size: 18px;
    font-weight: 700;
    padding: 18px;
    width: 65%;
    max-width: 600px;
    border-radius: 12px;
}

form {
    background: #ffffff;
    width: 420px;
    padding: 45px 40px;
    border-radius: 22px;
    box-shadow: 0 35px 55px rgba(0, 0, 0, 0.35);
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: 700;
    color: #444;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    height: 46px;
    border-radius: 8px;
    border: 1px solid #dddddd;
    padding: 0 14px;
    font-size: 15px;
    margin-bottom: 30px;
    background: #ffffff;
}

button {
    width: 100%;
    height: 52px;
    background: #ff7a00;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
}

button:hover {
    background: #e56d00;
}

p[style] {
    margin-top: 20px;
    font-size: 14px;
    font-weight: 600;
}

.register-link {
    margin-top: 20px;
    font-size: 14px;
}

.register-link a {
    color: #ff7a00;
    text-decoration: none;
    font-weight: 600;
}

.register-link a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>

<h2>DineCraft Restaurant</h2>
<h6>WELCOME CUSTOMER, PLEASE LOGIN TO CONTINUE</h6>
<p class="outset">CUSTOMER LOGIN</p>
<form action="/customer/login" method="POST">
    <?php echo csrf_field(); ?>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>

<?php if(session('error')): ?>
    <p style="color:red"><?php echo e(session('error')); ?></p>
<?php endif; ?>

<p class="register-link">Don't have an account? <a href="/customer/register">Register here</a></p>

</body>
</html><?php /**PATH C:\xampp\htdocs\DineCraft\resources\views/customer/login.blade.php ENDPATH**/ ?>