<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment Status</title>
<style>
/* ===== BODY VA FON ===== */
body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', Arial, sans-serif;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #ffd59e;
}

/* ===== OVERLAY ===== */
.wrapper {
    min-height: 100vh;
    padding: 50px 20px;
    background: rgba(0,0,0,0.65);
    backdrop-filter: blur(2px);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ===== CONTAINER ===== */
.container {
    width: 90%;
    max-width: 600px;
    background: rgba(0,0,0,0.85);
    padding: 35px 30px;
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.7);
    border: 2px solid #eab676;
    text-align: center;
}

/* ===== STATUS TEXT ===== */
h2 {
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: bold;
}

.success {
    color: #4CAF50; /* yashil */
}

.error {
    color: #FF4C4C; /* qizil */
}

/* ===== BUTTON ===== */
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
@media (max-width: 480px) {
    h2 { font-size: 24px; }
    .back-btn { font-size: 16px; padding: 12px 30px; }
}
</style>
</head>
<body>

<div class="wrapper">
<div class="container">

<?php
if (isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);

    $update = "UPDATE orders SET payment_status='Paid' WHERE id=$order_id";

    if (mysqli_query($connection, $update)) {
        echo "<h2 class='success'>✅ Payment Successful!</h2>";
        echo "<p>Your order ID <b>$order_id</b> has been paid.</p>";
    } else {
        echo "<h2 class='error'>❌ Payment Error.</h2>";
        echo "<p>There was a problem processing your payment.</p>";
    }
} else {
    echo "<h2 class='error'>❌ Invalid Request.</h2>";
    echo "<p>No order was selected.</p>";
}
?>

<a class="back-btn" href="menu.php">⬅ Back to Menu</a>

</div>
</div>

</body>
</html>

