<?php
include 'config.php';

// ===============================
// 1) ORDER QO‘SHISH (ADD ORDER)
// ===============================
if (isset($_POST['item_id']) && !isset($_POST['pay_now'])) {

    $item_id = intval($_POST['item_id']);
    $query = "SELECT * FROM menu WHERE id = $item_id LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {

        $item = mysqli_fetch_assoc($result);
        $name  = mysqli_real_escape_string($connection, $item['name']);
        $price = mysqli_real_escape_string($connection, $item['price']);
        $quantity = 1;

        $total_price = $price * $quantity;
        $status = "Pending";

        // Auto estimated time
        $prep_times = [
            "pizza" => 15,
            "samsa"  => 25,
            "cheeseburger" => 10,
            "pasta" => 8,
        ];

        $lower = strtolower($name);
        $estimated_time = $prep_times[$lower] ?? 15;

        $start_time = date("Y-m-d H:i:s");
        $order_status = "preparing";

        // Insert order
        $insert = "INSERT INTO orders 
            (items, total_price, status, estimated_time, order_status, start_time, payment_status) 
            VALUES 
            ('$name', $total_price, '$status', $estimated_time, '$order_status', '$start_time', 'Pending')";

        if (mysqli_query($connection, $insert)) {
            $order_id = mysqli_insert_id($connection);
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Added</title>
<style>
body {
    margin:0; padding:0;
    font-family: 'Poppins', sans-serif;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #ffd59e;
}

/* ===== OVERLAY ===== */
.overlay {
    width: 100%;
    min-height: 100vh;
    background: rgba(0,0,0,0.65);
    backdrop-filter: blur(3px);
    display:flex;
    justify-content:center;
    align-items:center;
    padding: 40px 0;
}

/* ===== CONTAINER ===== */
.container {
    width: 90%;
    max-width: 850px;
    background: rgba(0,0,0,0.7);
    padding: 40px 35px;
    border-radius: 18px;
    border: 2px solid #ffd59e;
    box-shadow: 0 12px 30px rgba(0,0,0,0.6);
    text-align:center;
}

/* ===== HEADINGS ===== */
h2, h3 {
    margin: 15px 0;
    font-weight: 700;
}

h2 {
    font-size: 34px;
    color: #ffd59e;
}

h3 {
    font-size: 26px;
    color: #ffcc88;
}

/* ===== TIMER ===== */
.timer {
    font-size: 40px;
    font-weight: bold;
    color: #ffcc88;
    margin: 20px 0;
}

/* ===== FORM ===== */
input {
    width: 80%;
    padding: 14px;
    margin: 10px 0;
    border: none;
    border-radius: 12px;
    font-size: 17px;
    outline: none;
    background: rgba(255,255,255,0.1);
    color: #ffd59e;
}

input::placeholder {
    color: #ffd59e;
    opacity: 0.8;
}

button {
    width: 85%;
    padding: 16px;
    margin-top: 20px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(90deg,#c28a52,#eab676);
    color:white;
    font-size: 20px;
    font-weight:700;
    cursor:pointer;
    transition:0.3s;
}

button:hover {
    background: linear-gradient(90deg,#eab676,#c28a52);
    color:black;
    transform: translateY(-3px);
}

/* ===== SEPARATOR LINE ===== */
hr {
    border:none;
    border-top:2px solid #ffd59e;
    margin: 30px 0;
}

/* ===== BACK LINK ===== */
.back-link a {
    display:inline-block;
    margin-top: 20px;
    padding: 14px 30px;
    background: linear-gradient(90deg,#c28a52,#eab676);
    color:white;
    font-weight:bold;
    border-radius:12px;
    text-decoration:none;
    transition:.3s;
}

.back-link a:hover {
    background: linear-gradient(90deg,#eab676,#c28a52);
    color:black;
    transform: translateY(-3px);
}

/* ===== RESPONSIVE ===== */
@media (max-width:600px){
    input, button { width: 90%; font-size:16px; }
    h2 { font-size:28px; }
    h3 { font-size:22px; }
}
</style>
</head>
<body>

<div class="overlay">
<div class="container">

    <h2>✔ Item Added Successfully!</h2>
    <p>You ordered: <b><?= htmlspecialchars($name) ?></b></p>
    <p>Estimated Time: <b><?= $estimated_time ?> minutes</b></p>

    <h3>⏳ Time Left</h3>
    <div id="timer" class="timer"></div>

    <script>
        let remaining = <?= $estimated_time * 60 ?>;
        function updateTimer() {
            if(remaining <= 0){
                document.getElementById('timer').innerHTML = "Ready!";
                return;
            }
            let min = Math.floor(remaining/60);
            let sec = remaining % 60;
            document.getElementById('timer').innerHTML = min + " min " + sec + " sec";
            remaining--;
            setTimeout(updateTimer,1000);
        }
        updateTimer();
    </script>

    <hr>

    <h3>💳 Pay with Card</h3>
    <form method="POST">
        <input type="hidden" name="pay_order_id" value="<?= $order_id ?>">
        <input type="text" name="card_number" placeholder="Card Number" required>
        <input type="text" name="expiry_date" placeholder="MM/YY" required>
        <input type="text" name="cvv" placeholder="CVV" required>
        <button type="submit" name="pay_now">Pay Now</button>
    </form>

    <div class="back-link">
        <a href="menu.php">⬅ Back to Menu</a>
    </div>

</div>
</div>

</body>
</html>

<?php
        } else {
            echo "<h3 style='color:red;text-align:center;'>Database Error!</h3>";
        }

    } else {
        echo "<h3 style='color:red;text-align:center;'>Item Not Found!</h3>";
    }
    exit;
}


// ===============================
// 2) PAYMENT PART
// ===============================
if (isset($_POST['pay_now']) && isset($_POST['pay_order_id'])) {

    $order_id = intval($_POST['pay_order_id']);

    $pay = "UPDATE orders SET payment_status='Paid' WHERE id=$order_id";

    if (mysqli_query($connection, $pay)) {
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Success</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    margin:0;
    padding:0;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #ffd59e;
}

.overlay {
    width:100%;
    min-height:100vh;
    background: rgba(0,0,0,0.65);
    backdrop-filter: blur(3px);
    display:flex;
    justify-content:center;
    align-items:center;
}

.container {
    width:85%;
    max-width:700px;
    background: rgba(0,0,0,0.7);
    padding:50px;
    border-radius:20px;
    border:2px solid #ffd59e;
    box-shadow:0 10px 35px rgba(0,0,0,0.6);
    text-align:center;
}

h2 {
    font-size:34px;
    color:#ffd59e;
    font-weight:700;
    margin-bottom:20px;
}

a {
    padding: 15px 35px;
    background:linear-gradient(90deg,#c28a52,#eab676);
    color:white;
    text-decoration:none;
    border-radius:12px;
    font-size:20px;
    font-weight:bold;
    transition:.3s;
}

a:hover {
    background:linear-gradient(90deg,#eab676,#c28a52);
    color:black;
    transform: translateY(-3px);
}
</style>
</head>
<body>

<div class="overlay">
<div class="container">
    <h2>✔ Payment Successful!</h2>
    <p>Your Order ID: <b><?= $order_id ?></b></p>
    <a href="menu.php">Back to Menu</a>
</div>
</div>

</body>
</html>

<?php
    } else {
        echo "<h3 style='color:red;text-align:center;'>Payment Error!</h3>";
    }
    exit;
}
?>











