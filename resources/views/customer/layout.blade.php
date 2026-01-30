<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DineCraft</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
</head>
<body style="background:#fff6ed">
    <header class="site-header">
        <div class="site-header-inner">
            <div class="brand">
                <a href="/customer/home" class="logo-link">
                    <div class="logo">
                        <div class="logo-icon">🍕</div>
                        <div class="logo-text">Dinecraft</div>
                    </div>
                </a>
            </div>
            <nav class="site-nav">
                <a href="/customer/menu">Menu</a>
                <span class="sep">|</span>
                <a href="/customer/cart">Cart</a>
                <span class="sep">|</span>
                <a href="/customer/orders">Orders</a>
            </nav>
            <div class="site-actions">
                <a href="/customer/login" class="login-btn">Login <span class="user-icon">👤</span></a>
            </div>
        </div>
    </header>

    <main class="main container">
        @yield('content')
    </main>

    <footer style="text-align:center;padding:30px 0;color:#b36a24">
        &copy; {{ date('Y') }} DineCraft
    </footer>
</body>
</html>