<?php
session_start();
include 'config.php';

// Foydalanuvchi tizimga kirganini tekshirish
if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? 'User';

// Foydalanuvchi ma'lumotlari
$result = mysqli_query($connection, "SELECT * FROM user WHERE id='$user_id'");
$user = mysqli_fetch_assoc($result);

// Oxirgi 5 ta order
$orders = mysqli_query($connection, "SELECT * FROM orders ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Profile</title>
<style>
/* ===== BODY & BACKGROUND ===== */
body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', Arial, sans-serif;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #ffd59e;
}

/* ===== DARK OVERLAY ===== */
.overlay {
     min-height: 100vh;
     padding: 30px 20px;
     background: rgba(0,0,0,0.7);
     backdrop-filter: blur(3px);
}

/* ===== NAVBAR ===== */
.navbar {
    background: linear-gradient(90deg, #c28a52, #eab676);
    color: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.5);
}
.navbar h1 {
    margin: 0;
    font-size: 22px;
}
.navbar a {
    color:white;
    text-decoration:none;
    border:2px solid #f3c896;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: bold;
    transition:0.3s;
}
.navbar a:hover {
    background:#f3c896;
    color:black;
}

/* ===== PROFILE BOX ===== */
.profile-box {
    width: 90%;
    max-width: 450px;
    margin: 30px auto;
    background: rgba(255,255,255,0.05);
    padding: 30px 25px;
    border-radius: 18px;
    border-left: 5px solid #c28a52;
    border-right: 5px solid #c28a52;
    box-shadow: 0 12px 30px rgba(0,0,0,0.5);
    text-align: center;
}
.profile-box h2 {
    color: #ffd59e;
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: bold;
}
.profile-box p {
    font-size: 18px;
    margin: 10px 0;
    color: #fff;
}

/* ===== ORDER HISTORY CONTAINER ===== */
.container {
    width: 90%;
    max-width: 900px;
    margin: 30px auto;
    background: rgba(255,255,255,0.05);
    padding: 35px;
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.5);
    border: 2px solid #ffd59e;
}

/* ===== HEADINGS ===== */
h2 {
    color: #ffd59e;
    text-align: center;
    font-size: 28px;
    margin-bottom: 25px;
    font-weight: bold;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 18px;
}
th {
    background: linear-gradient(90deg, #c28a52, #eab676);
    padding: 14px;
    color: white;
    text-transform: uppercase;
}
td {
    background: rgba(255,255,255,0.1);
    padding: 14px;
    text-align: center;
    border-bottom: 1px solid rgba(255,215,150,0.3);
    color: #fff;
    font-weight: bold;
}
tr:hover td {
    background: rgba(255,255,255,0.2);
    transition: 0.3s;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 600px) {
    .navbar h1 { font-size: 18px; }
    .profile-box h2 { font-size: 24px; }
    .container h2 { font-size: 24px; }
    td, th { font-size: 14px; padding: 10px; }
    .navbar a { padding: 6px 15px; font-size: 14px; }
}
</style>
</head>
<body>

<div class="overlay">

    <!-- NAVBAR -->
    <div class="navbar">
        <h1>Welcome, <?= htmlspecialchars($user_name) ?> 👋</h1>
        <a href="logout.php">Logout</a>
    </div>

    <!-- PROFILE INFO BOX -->
    <div class="profile-box">
        <h2>Your Profile</h2>
        <p><b>Name:</b> <?= htmlspecialchars($user['name']) ?></p>
        <p><b>Email:</b> <?= htmlspecialchars($user['email']) ?></p>
    </div>

    <!-- ORDER HISTORY -->
    <div class="container">
        <h2>Your Last 5 Orders</h2>

        <?php if ($orders && mysqli_num_rows($orders) > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Time</th>
                    <th>Date</th>
                </tr>

                <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['items']) ?></td>
                    <td>$<?= htmlspecialchars($order['total_price']) ?></td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td><?= $order['estimated_time'] ?> min</td>
                    <td><?= $order['start_time'] ?></td>
                </tr>
                <?php endwhile; ?>

            </table>
        <?php else: ?>
            <p style="text-align:center; font-size:20px; color:#ffd59e;">No orders yet.</p>
        <?php endif; ?>

    </div>

</div>
</body>
</html>








