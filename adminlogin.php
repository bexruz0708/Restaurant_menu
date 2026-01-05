<?php
session_start();
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_users WHERE username='$username'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        if ($password === $admin['password']) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['username'];
            $_SESSION['admin_role'] = $admin['role'];

            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "❌ Wrong password!";
        }
    } else {
        $error = "❌ Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
/* ===== BODY & BACKGROUND ===== */
body {
    margin: 0;
    font-family: 'Poppins', Arial, sans-serif;
    background: url('images/admin.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #ffd59e;
}

/* ===== DARK OVERLAY ===== */
.overlay {
    width: 100%;
    min-height: 100vh;
    background: rgba(0,0,0,0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    box-sizing: border-box;
}

/* ===== LOGIN BOX ===== */
.login-box {
    background: rgba(0,0,0,0.85);
    padding: 40px 35px;
    width: 400px;
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.7);
    animation: fadeIn 0.6s ease forwards;
    border: 2px solid #eab676;
}

/* ===== ANIMATION ===== */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

/* ===== HEADERS ===== */
h2 {
    text-align: center;
    color: #ffd59e;
    font-weight: 700;
    margin-bottom: 25px;
    font-size: 28px;
}

/* ===== INPUTS & BUTTONS ===== */
input, button {
    width: 100%;
    padding: 14px;
    margin-top: 12px;
    font-size: 16px;
    border-radius: 10px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    transition: 0.3s;
}

input:focus {
    border-color: #ffd59e;
    box-shadow: 0 0 8px #ffd59eaa;
    outline: none;
}

button {
    background: linear-gradient(90deg, #c28a52, #eab676);
    border: none;
    color: black;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(194,138,82,0.5);
    transition: background 0.25s, transform 0.2s;
}

button:hover {
    background: linear-gradient(90deg, #eab676, #c28a52);
    color: white;
    transform: scale(1.05);
}

/* ===== ERROR MESSAGE ===== */
.error {
    color: #ff4c4c;
    text-align: center;
    margin-top: 15px;
    font-weight: 600;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 450px) {
    .login-box {
        width: 100%;
        padding: 25px 20px;
        border-radius: 12px;
    }
}
</style>
</head>
<body>

<div class="overlay">
    <div class="login-box">
        <h2>Admin Login</h2>

        <?php if ($error != "") echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</div>

</body>
</html>




