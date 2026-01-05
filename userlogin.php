<?php
session_start();
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $db_password = $user['password'];

        // UNIVERSAL PASSWORD CHECK
        if ($password === $db_password || password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: profile.php");
            exit();
        } else {
            $error = "❌ Wrong password!";
        }
    } else {
        $error = "❌ No user found with this email!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Login</title>
<style>
/* ===== BODY & BACKGROUND ===== */
body {
    margin: 0;
    font-family: 'Poppins', Arial, sans-serif;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #fff;
}

/* ===== DARK OVERLAY ===== */
.bg-overlay {
    width: 100%;
    height: 100vh;
    background: rgba(0,0,0,0.65); /* shaffof qora fon */
    backdrop-filter: blur(3px);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ===== LOGIN CARD ===== */
.login-card {
    width: 380px;
    max-width: 90%;
    background: rgba(255, 255, 255, 0.1); /* shaffof oyna */
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.6);
    border: 1px solid rgba(234,182,118,0.6); /* tilla aksent */
    animation: fadeIn 0.6s ease;
    backdrop-filter: blur(5px);
}

/* ===== ANIMATION ===== */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

/* ===== TITLE ===== */
.login-card h2 {
    text-align: center;
    color: #eab676; /* tilla rang */
    margin-bottom: 25px;
    font-size: 28px;
}

/* ===== INPUTS ===== */
.login-card input {
    width: 100%;
    padding: 14px;
    margin-top: 12px;
    border-radius: 12px;
    border: 1px solid rgba(234,182,118,0.6); /* tilla aksent */
    font-size: 16px;
    background: rgba(0,0,0,0.5);
    color: white;
    transition: 0.3s;
}

.login-card input::placeholder {
    color: #f0e2c2;
}

.login-card input:focus {
    border-color: #eab676;
    box-shadow: 0 0 8px rgba(234,182,118,0.6);
    outline: none;
}

/* ===== BUTTON ===== */
.login-card button {
    width: 100%;
    padding: 16px;
    margin-top: 20px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(90deg, #c28a52, #eab676);
    color: #fff;
    font-size: 17px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 6px 18px rgba(0,0,0,0.35);
    transition: 0.3s;
}

.login-card button:hover {
    background: linear-gradient(90deg, #eab676, #c28a52);
    transform: scale(1.05);
}

/* ===== ERROR MESSAGE ===== */
.error {
    color: #ffd59e; /* tilla rang xabar */
    text-align: center;
    margin-bottom: 12px;
    font-weight: bold;
    background: rgba(0,0,0,0.5);
    padding: 8px 12px;
    border-radius: 10px;
}

/* ===== SIGN UP LINK ===== */
.login-card p {
    margin-top: 15px;
    text-align: center;
    color: #f3d8a0;
}

.login-card a {
    color: #eab676;
    font-weight: bold;
    text-decoration: none;
}

.login-card a:hover {
    text-decoration: underline;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 480px) {
    .login-card {
        padding: 30px 20px;
    }
    .login-card h2 { font-size: 24px; }
    .login-card input, .login-card button { font-size: 15px; padding: 12px; }
}
</style>
</head>

<body>
<div class="bg-overlay">
    <div class="login-card">
        <h2>User Login</h2>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p>Not registered? <a href="signup.php">Sign up here</a></p>
    </div>
</div>
</body>
</html>






