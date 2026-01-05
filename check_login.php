<?php
session_start();
include 'config.php';

$username = $_POST['username'] ?? "";  // TO‘G‘RILANDI!!!
$password = $_POST['password'] ?? "";

// ADMINNI TEKSHIRISH
$query = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    $_SESSION['admin_username'] = $user['username'];
    $_SESSION['admin_role'] = $user['role'];

    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Incorrect username or password!";
}
?>

