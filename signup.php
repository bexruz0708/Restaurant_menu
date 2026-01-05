<?php
include 'config.php';
session_start();

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name  = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $message = "<p class='error'>❌ Passwords do not match!</p>";
    } else {
        // Email exists?
        $check = mysqli_query($connection, "SELECT * FROM user WHERE email='$email'");

        if (mysqli_num_rows($check) > 0) {
            $message = "<p class='error'>❌ This email is already registered!</p>";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $insert = "INSERT INTO user (name, email, password) 
                       VALUES ('$name', '$email', '$hash')";

            if (mysqli_query($connection, $insert)) {
                $message = "<p class='success'>🎉 Registration successful! 
                            <a href='userlogin.php'>Login here</a></p>";
            } else {
                $message = "<p class='error'>❌ Database error!</p>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>

<style>
/* ===== BODY & BACKGROUND ===== */
body {
    margin: 0;
    font-family: 'Poppins', Arial, sans-serif;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #ffd59e;
}

/* ===== DARK OVERLAY ===== */
.overlay {
    width: 100%;
    height: 100vh;
    background: rgba(0,0,0,0.65);
    backdrop-filter: blur(3px);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ===== SIGNUP CARD ===== */
.card {
    width: 420px;
    max-width: 90%;
    background: rgba(255,255,255,0.05);
    padding: 40px 30px;
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.5);
    border: 2px solid #ffd59e;
    animation: fadeIn .6s ease;
}

@keyframes fadeIn {
    from {opacity:0; transform: translateY(20px);}
    to {opacity:1; transform: translateY(0);}
}

/* ===== TITLE ===== */
.card h2 {
    text-align: center;
    color: #ffd59e;
    margin-bottom: 25px;
    font-size: 28px;
    font-weight: bold;
}

/* ===== INPUT STYLES ===== */
.card input {
    width: 100%;
    padding: 14px;
    margin-top: 12px;
    font-size: 16px;
    border-radius: 12px;
    border: 1px solid #ccc;
    background: rgba(255,255,255,0.1);
    color: #fff;
    transition: 0.3s;
}

.card input::placeholder {
    color: #ffd59e;
    opacity: 0.8;
}

.card input:focus {
    border-color: #c28a52;
    box-shadow: 0 0 8px #c28a52aa;
    outline: none;
    background: rgba(255,255,255,0.15);
}

/* ===== BUTTON ===== */
.card button {
    width: 100%;
    padding: 16px;
    margin-top: 20px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(90deg, #c28a52, #eab676);
    color: white;
    font-size: 17px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 6px 18px rgba(0,0,0,0.35);
    transition: 0.3s;
}

.card button:hover {
    background: linear-gradient(90deg, #eab676, #c28a52);
    transform: scale(1.05);
}

/* ===== MESSAGES ===== */
.error {
    color: #ff4d4d;
    font-weight: bold;
    text-align: center;
    margin-bottom: 10px;
}

.success {
    color: #ffd59e;
    font-weight: bold;
    text-align: center;
    margin-bottom: 10px;
}

/* ===== LINK ===== */
.card p {
    text-align: center;
    margin-top: 15px;
    color: #ffd59e;
}
.card a {
    color: #ffd59e;
    font-weight: bold;
    text-decoration: none;
}
.card a:hover {
    text-decoration: underline;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 480px) {
    .card {
        padding: 30px 20px;
    }
    .card h2 { font-size: 24px; }
    .card input, .card button { font-size: 15px; padding: 12px; }
}
</style>
</head>
<body>

<div class="overlay">
    <div class="card">
        <h2>Create Account</h2>

        <?= $message ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <button type="submit">Sign Up</button>
        </form>

        <p>Already have an account? <a href="userlogin.php">Login here</a></p>
    </div>
</div>

</body>
</html>



