<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Feedback</title>

<style>
/* === GLOBAL BACKGROUND === */
body {
    margin: 0;
    font-family: 'Poppins', Arial, sans-serif;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
}

/* === DARK GOLDISH OVERLAY === */
.overlay {
    width: 100%;
    min-height: 100vh;
    background: rgba(0,0,0,0.55); /* Slightly darker */
    backdrop-filter: blur(4px);
    display: flex;
    flex-direction: column;
}

/* === NAVBAR === */
.navbar {
    background: rgba(194, 138, 82, 0.85);
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    backdrop-filter: blur(3px);
    border-bottom: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
}

.navbar a {
    color: white;
    text-decoration: none;
    border: 2px solid rgba(255, 225, 185, 0.8);
    padding: 6px 15px;
    border-radius: 20px;
    transition: 0.3s;
}

.navbar a:hover {
    background: #eab676;
    color: black;
}

/* === GLASSMORPHIC FORM CARD === */
.container {
    max-width: 520px;
    margin: 60px auto;
    padding: 35px 40px;
    border-radius: 18px;

    /* GLASS EFFECT */
    background: rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);

    border: 1px solid rgba(255,255,255,0.3);
    box-shadow: 0 12px 40px rgba(0,0,0,0.35);

    animation: fadeIn .6s ease;
}

/* === ANIMATION === */
@keyframes fadeIn {
    from {opacity:0; transform: translateY(20px);}
    to {opacity:1; transform: translateY(0);}
}

/* === TITLES === */
h1, h2 {
    margin: 0;
    font-weight: 700;
    color: #f7d6a3;
    text-shadow: 0 0 8px rgba(0,0,0,0.6);
}

h2 {
    text-align: center;
    margin-bottom: 25px;
}

/* === FORM ELEMENTS === */
label {
    font-weight: 600;
    display: block;
    margin-top: 15px;
    color: #fff;
}

input[type="text"],
textarea,
input[type="number"] {
    width: 100%;
    padding: 14px;
    margin-top: 6px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.4);
    background: rgba(255,255,255,0.2);
    color: #fff;
    font-size: 16px;
    transition: 0.3s;
}

input:focus,
textarea:focus {
    border-color: #ffd59e;
    background: rgba(255,255,255,0.3);
    box-shadow: 0 0 8px #ffc78c;
}

textarea {
    resize: vertical;
    min-height: 120px;
}

/* === BUTTON === */
button {
    width: 100%;
    padding: 14px;
    margin-top: 25px;
    background: linear-gradient(90deg, #c28a52, #eab676);
    color: white;
    font-size: 18px;
    font-weight: 700;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: 0.25s;
    box-shadow: 0 6px 18px rgba(194,138,82,0.7);
}

button:hover {
    background: linear-gradient(90deg, #eab676, #c28a52);
    transform: scale(1.06);
    color: black;
}

/* === RESPONSIVE === */
@media (max-width: 600px) {
    .container {
        width: 85%;
        padding: 25px 25px;
        margin: 40px auto;
    }
}
</style>
</head>
<body>

<div class="overlay">

    <div class="navbar">
        <h1>Feedback</h1>
        <a href="menu.php">Home</a>
    </div>

    <div class="container">
        <h2>Give Your Feedback</h2>

        <form action="save_feedback.php" method="POST">

            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" required></textarea>

            <label for="rating">Rating (1 to 5):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>

            <button type="submit">Submit</button>

        </form>
    </div>

</div>

</body>
</html>




