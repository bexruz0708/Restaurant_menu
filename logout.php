<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logout</title>
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

/* ===== DARK OVERLAY ===== */
.wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: rgba(0,0,0,0.65);
    backdrop-filter: blur(2px);
}

/* ===== SHAFFOF CONTAINER ===== */
.logout-box {
    width: 420px;
    background: rgba(0,0,0,0.85);
    padding: 40px 35px;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 12px 35px rgba(0,0,0,0.7);
    border: 2px solid #eab676;
}

/* ===== TITLE ===== */
.logout-box h2 {
    color: #ffd59e;
    font-size: 28px;
    margin-bottom: 20px;
}

/* ===== MESSAGE ===== */
.logout-box p {
    font-size: 16px;
    margin-bottom: 25px;
}

/* ===== BUTTON ===== */
.logout-box a {
    display: inline-block;
    padding: 14px 30px;
    background: linear-gradient(90deg,#c28a52,#eab676);
    color: black;
    font-weight: bold;
    text-decoration: none;
    border-radius: 12px;
    border: 2px solid #eab676;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.35);
}

.logout-box a:hover {
    background: linear-gradient(90deg,#eab676,#c28a52);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 7px 16px rgba(0,0,0,0.5);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 600px) {
    .logout-box {
        width: 90%;
        padding: 30px 25px;
    }
    .logout-box h2 {
        font-size: 24px;
    }
    .logout-box a {
        font-size: 16px;
        padding: 12px 25px;
    }
}
</style>
</head>
<body>

<div class="wrapper">
    <div class="logout-box">
        <h2>✅ You have been logged out!</h2>
        <p>Thank you for visiting our restaurant.</p>
        <a href="login.php">Login Again</a>
    </div>
</div>

</body>
</html>

