<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DineCraft | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            <span>DineCraft</span>
        </div>

        <nav class="nav">
            <a class="active"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a><i class="fa-solid fa-users"></i> Manage Staff</a>
            <a><i class="fa-solid fa-utensils"></i> Manage Menu</a>
            <a><i class="fa-solid fa-bag-shopping"></i> Orders</a>
            <a><i class="fa-solid fa-credit-card"></i> Payments</a>
            <a><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">

        <!-- TOP BAR -->
        <header class="topbar">
            <h2>Admin Dashboard</h2>

            <div class="admin-info">
                <span>Welcome, Admin</span>
                
            </div>
        </header>

        <!-- STATS -->
        <section class="stats">
            <div class="stat-card">
                <p>Total Revenue</p>
                <h3>₹ 0.00</h3>
            </div>

            <div class="stat-card">
                <p>Total Orders</p>
                <h3>0</h3>
            </div>

            <div class="stat-card">
                <p>Staff Members</p>
                <h3>0</h3>
            </div>

            <div class="stat-card">
                <p>Menu Items</p>
                <h3>0</h3>
            </div>
        </section>

        <!-- TABLE -->
        <section class="table-card">
            <div class="table-header">
                <h3>Recent Orders</h3>
                <button class="btn">View All</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>#0001</td>
                        <td>Customer Name</td>
                        <td>₹ 0.00</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td>#0002</td>
                        <td>Customer Name</td>
                        <td>₹ 0.00</td>
                        <td><span class="status completed">Completed</span></td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

</div>

</body>
</html>
