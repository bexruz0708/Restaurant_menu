<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'] ?? 0;

$query = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY start_time DESC";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Orders</title>
<style>
/* ===== BODY VA FON ===== */
body {
    font-family: 'Poppins', Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #ffd59e;
}

/* ===== OVERLAY ===== */
.wrapper {
    min-height: 100vh;
    padding: 40px 0;
    background: rgba(0,0,0,0.65);
    backdrop-filter: blur(2px);
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

/* ===== CONTAINER ===== */
.container {
    width: 95%;
    max-width: 950px;
    background: rgba(0,0,0,0.85);
    padding: 40px 30px;
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.7);
    border: 2px solid #eab676;
}

/* ===== HEADER ===== */
h2 {
    text-align: center;
    color: #ffd59e;
    font-size: 32px;
    margin-bottom: 25px;
    font-weight: bold;
}

/* ===== TABLE DESIGN ===== */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 18px;
}

th {
    background: linear-gradient(90deg,#c28a52,#eab676);
    color: black;
    padding: 14px;
    border-radius: 6px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

td {
    background: rgba(255,248,239,0.95);
    padding: 14px;
    text-align: center;
    border-bottom: 2px solid #f1d5b8;
    color: #3b1f00;
}

tr:hover td {
    background: #fff0db;
    transition: 0.3s;
}

/* ===== TIMER ===== */
td#timer {
    font-weight: bold;
    color: #d2691e;
}

/* ===== BACK BUTTON ===== */
.back-btn {
    display: inline-block;
    margin-top: 25px;
    padding: 14px 35px;
    background: linear-gradient(90deg,#c28a52,#eab676);
    color: black;
    text-decoration: none;
    border-radius: 12px;
    font-weight: bold;
    font-size: 18px;
    border: 2px solid #eab676;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.35);
}

.back-btn:hover {
    background: linear-gradient(90deg,#eab676,#c28a52);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 7px 16px rgba(0,0,0,0.5);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    h2 { font-size: 28px; }
    td, th { font-size: 16px; padding: 12px; }
    .back-btn { font-size: 16px; padding: 12px 30px; }
}
</style>
</head>
<body>

<div class="wrapper">
<div class="container">

    <h2>Your Orders</h2>

    <?php if($result && mysqli_num_rows($result) > 0): ?>
    <table>
        <tr>
            <th>Item</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Time Left</th>
        </tr>

        <?php while($order = mysqli_fetch_assoc($result)) { 
            $start_time = strtotime($order['start_time']);
            $end_time   = $start_time + ($order['estimated_time'] * 60);
            $remaining  = max(0, $end_time - time());
        ?>
        <tr>
            <td><?= htmlspecialchars($order['items']) ?></td>
            <td>$<?= htmlspecialchars($order['total_price']) ?></td>
            <td><?= htmlspecialchars(ucfirst($order['order_status'])) ?></td>
            <td id="timer-<?= $order['id'] ?>">Loading...</td>
        </tr>

        <script>
            let remain<?= $order['id'] ?> = <?= $remaining ?>;
            function updateTimer<?= $order['id'] ?>() {
                let el = document.getElementById("timer-<?= $order['id'] ?>");
                if(remain<?= $order['id'] ?> <= 0){
                    el.innerHTML = "Ready!";
                    el.style.color = "green";
                    return;
                }
                let m = Math.floor(remain<?= $order['id'] ?> / 60);
                let s = remain<?= $order['id'] ?> % 60;
                el.innerHTML = m + " min " + s + " sec";
                remain<?= $order['id'] ?>--;
                setTimeout(updateTimer<?= $order['id'] ?>, 1000);
            }
            updateTimer<?= $order['id'] ?>();
        </script>

        <?php } ?>
    </table>
    <?php else: ?>
        <p style="text-align:center; color:#ffd59e; font-size:18px; margin-top:20px;">You have no orders yet.</p>
    <?php endif; ?>

    <center>
        <a class="back-btn" href="menu.php">⬅ Back to Menu</a>
    </center>

</div>
</div>

</body>
</html>


