<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}

$query = "SELECT * FROM orders ORDER BY start_time DESC LIMIT 10";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<style>
/* ===== BODY & BACKGROUND ===== */
body {
    font-family: 'Poppins', sans-serif;
    margin:0;
    padding:0;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
}

/* ===== OVERLAY ===== */
.overlay {
    width:100%;
    min-height:100vh;
    background: rgba(0,0,0,0.45); /* shaffof oyna */
    backdrop-filter: blur(3px);
    padding: 30px 0;
    display:flex;
    flex-direction: column;
    align-items: center;
}

/* ===== NAVBAR ===== */
.navbar {
    width: 90%;
    max-width: 1200px;
    background: rgba(194,138,82,0.9);
    color:white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    border-radius: 0 0 15px 15px;
    margin-bottom: 30px;
}
.navbar h1 { margin:0; font-size:26px; }
.navbar a {
    color:white;
    text-decoration:none;
    font-weight:bold;
    border:2px solid #eab676;
    padding:6px 15px;
    border-radius:20px;
    transition:0.3s;
}
.navbar a:hover { background:#eab676; color:black; }

/* ===== CONTAINER ===== */
.container {
    width:90%;
    max-width:1200px;
    padding: 30px 25px;
    backdrop-filter: blur(10px);
}

/* ===== TITLE ===== */
h2 {
    color: #ffd59e;
    text-align:center;
    font-size:32px;
    margin-bottom:25px;
}

/* ===== TABLE ===== */
table {
    width:100%;
    border-collapse: collapse;
}

th, td {
    padding:14px;
    text-align:center;
    border: 1px solid rgba(255,215,150,0.5);
    border-radius: 5px;
    color: white; /* oq yozuv */
    background: rgba(255,255,255,0.2); /* shaffof fon */
}

th {
    background: rgba(234,182,118,0.8); /* biroz yorqinroq header */
    color: #3b1f00;
    font-weight:600;
    text-transform: uppercase;
}

/* Hover effekt */
tr:hover td {
    background: rgba(255,255,255,0.35);
    transition:0.3s;
}

/* ===== RESPONSIVE ===== */
@media (max-width:768px) {
    .container { width:95%; padding:20px; }
    th, td { font-size:14px; padding:10px; }
    h2 { font-size:26px; }
}
</style>
</head>
<body>
<div class="overlay">

<div class="navbar">
    <h1>Admin Dashboard</h1>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Last 10 Orders</h2>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Items</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Estimated Time</th>
            <th>Order Time</th>
            <th>Payment</th>
        </tr>
        <?php while($order = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($order['id']) ?></td>
            <td><?= htmlspecialchars($order['items']) ?></td>
            <td>$<?= htmlspecialchars($order['total_price']) ?></td>
            <td><?= htmlspecialchars($order['status']) ?></td>
            <td><?= htmlspecialchars($order['estimated_time']) ?> min</td>
            <td><?= $order['start_time'] ?></td>
            <td><?= htmlspecialchars($order['payment_status']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p style="text-align:center; color:#ffd59e;">No orders yet.</p>
    <?php endif; ?>
</div>

</div>
</body>
</html>












