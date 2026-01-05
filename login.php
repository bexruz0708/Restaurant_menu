<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Options</title>
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
.container {
    width: 420px;
    background: rgba(0,0,0,0.85);
    padding: 45px 40px;
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.7);
    text-align: center;
    border: 2px solid #eab676;
}

/* ===== TITLE ===== */
h2 {
    color: #ffd59e;
    margin-bottom: 35px;
    font-size: 30px;
    letter-spacing: 1px;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.25);
}

/* ===== BUTTONS ===== */
.button {
    display: block;
    width: 100%;
    padding: 16px;
    margin: 12px 0;
    background: linear-gradient(90deg, #c28a52, #eab676);
    color: black;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 12px;
    border: 2px solid #eab676;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.35);
}

.button:hover {
    background: linear-gradient(90deg, #eab676, #c28a52);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 7px 16px rgba(0,0,0,0.5);
}

/* ===== BACK TO MENU BUTTON – GOLD STYLE ===== */
.back-btn {
    background: rgba(0,0,0,0.6);
    border: 2px solid gold;
    color: gold;
}
.back-btn:hover {
    background: rgba(0,0,0,0.85);
    color: white;
    border-color: white;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 600px) {
    .container {
        width: 85%;
        padding: 35px 25px;
    }
    h2 {
        font-size: 26px;
    }
    .button {
        font-size: 16px;
        padding: 14px;
    }
}
</style>
</head>
<body>

<div class="wrapper">
    <div class="container">
        <h2>Login Options</h2>

        <a class="button" href="userlogin.php">User Login</a>
        <a class="button" href="adminlogin.php">Admin Login</a>
        <a class="button" href="signup.php">Sign Up</a>
        <a class="button" href="feedback.php">Feedback</a>

        <!-- BACK TO MENU BUTTON -->
        <a class="button back-btn" href="menu.php">⬅ Back to Menu</a>
    </div>
</div>

</body>
</html>




