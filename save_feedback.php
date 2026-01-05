<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Feedback Submission</title>

<style>
/* BACKGROUND */
body {
    margin: 0;
    font-family: 'Poppins', Arial, sans-serif;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
}

/* DARK OVERLAY */
.overlay {
    width: 100%;
    min-height: 100vh;
    background: rgba(0,0,0,0.50);
    backdrop-filter: blur(3px);
    display: flex;
    flex-direction: column;
}

/* NAVBAR */
.navbar {
    background: rgba(194,138,82,0.85);
    padding: 15px 30px;
    display:flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    backdrop-filter: blur(4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
}

.navbar a {
    color:white;
    text-decoration:none;
    border:2px solid rgba(255,225,185,0.8);
    padding:6px 15px;
    border-radius:20px;
    transition:0.3s;
}

.navbar a:hover {
    background:#eab676;
    color:black;
}

/* GLASS BOX */
.container {
    max-width: 550px;
    margin: 70px auto;
    padding: 35px 40px;
    
    /* GLASS EFFECT */
    background: rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.35);
    
    border-radius: 18px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.35);
    text-align: center;
    animation: fadeIn .6s ease;
}

@keyframes fadeIn {
    from {opacity:0; transform: translateY(25px);}
    to {opacity:1; transform: translateY(0);}
}

/* TITLES */
h1 {
    margin: 0;
    color: #f7d6a3;
    font-weight: 700;
    text-shadow: 0 0 6px rgba(0,0,0,0.6);
}

h2 {
    color: #ffd9a3;
    margin-bottom: 25px;
    font-weight: 700;
    text-shadow: 0 0 5px rgba(0,0,0,0.5);
}

/* MESSAGE */
.message {
    font-size: 19px;
    margin-bottom: 15px;
    font-weight: 600;
    color: #fff;
}

/* BUTTONS */
.button {
    display: inline-block;
    margin-top: 18px;
    padding: 12px 22px;
    background: linear-gradient(90deg, #c28a52, #eab676);
    border-radius: 10px;
    color: #fff;
    font-weight: 700;
    font-size: 18px;
    text-decoration: none;
    transition: 0.3s;
    box-shadow: 0 5px 15px rgba(194,138,82,0.5);
}

.button:hover {
    background: linear-gradient(90deg,#eab676,#c28a52);
    color: black;
    transform: scale(1.05);
}
</style>

</head>
<body>

<div class="overlay">

    <div class="navbar">
        <h1>Restaurant Feedback</h1>
        <a href="menu.php">Home</a>
    </div>

    <div class="container">
        <h2>Feedback Status</h2>

<?php
// Form values
$customer_name = $_POST['customer_name'] ?? "";
$comments      = $_POST['comments'] ?? "";
$rating        = $_POST['rating'] ?? "";

// Check fields
if ($customer_name == "" || $comments == "" || $rating == "") {
    echo "<p class='message' style='color:#ffb3b3;'>❌ Please fill all fields.</p>";
    echo "<a class='button' href='feedback.php'>Go Back</a>";
    exit;
}

// Save into DB
$query = "INSERT INTO feedback (customer_name, comments, rating)
          VALUES ('$customer_name', '$comments', '$rating')";

if (mysqli_query($connection, $query)) {
    echo "<p class='message' style='color:#b8ffb8;'>🎉 Thank you, <strong>" . htmlspecialchars($customer_name) . "</strong>! Your feedback has been submitted.</p>";
    echo "<p style='color:#fff;'>Your opinion helps us improve our service! 🍽️</p>";
    echo "<a class='button' href='menu.php'>Back to Home</a>";
} else {
    echo "<p class='message' style='color:#ffb3b3;'>❌ Error saving feedback.</p>";
    echo "<a class='button' href='feedback.php'>Try Again</a>";
}
?>

    </div>

</div>

</body>
</html>



