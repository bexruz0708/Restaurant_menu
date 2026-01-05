<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Restaurant Menu</title>
<style>
body {
    font-family: 'Poppins', Arial, sans-serif;
    margin:0; padding:0;
    background: url('images/menu.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #ffd59e;
}

/* NAVBAR */
.navbar {
    position: absolute;
    top:0;
    left:0;
    width:100%;
    padding:18px 20px;
    display:flex;
    justify-content:flex-start;
    align-items:center;
    z-index:20;
    background: rgba(0,0,0,0.5);
}

.navbar a {
    font-size:18px;
    color:white;
    font-weight:bold;
    text-decoration:none;
    border:2px solid #eab676;
    padding:8px 18px;
    border-radius:25px;
    transition:0.3s;
    margin-right:10px;
}

.navbar a:hover {
    background:#eab676;
    color:black;
}

/* SIGN IN DROPDOWN */
#sign-links {
    display:none;
    position:absolute;
    top:60px;
    left:20px;
    background: rgba(0,0,0,0.7);
    border:2px solid #eab676;
    border-radius:12px;
    padding:15px 0;
    width:180px;
    flex-direction: column;
    z-index:50;
}

#sign-links a {
    display:block;
    color:#ffd59e;
    text-decoration:none;
    padding:12px 20px;
    font-weight:bold;
    transition:0.3s;
}

#sign-links a:hover {
    background:#eab676;
    color:black;
    border-radius:10px;
}

/* HERO */
.hero {
    width:100%;
    height:90vh;
    background: url('https://images.unsplash.com/photo-1555992336-cbf8faadeda4') center/cover no-repeat;
    position: relative;
    display:flex;
    align-items:center;
    justify-content:center;
    transition: opacity 0.8s ease;
}

.hero.hidden { opacity:0; display:none; }

.hero::after {
    content:"";
    position:absolute;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.65);
}

.hero-content {
    position:relative;
    text-align:center;
    z-index:2;
}

.hero h1 { font-size:50px; }
.hero span { color:#eab676; }

/* OUR MENU BUTTON */
.hero-btn a {
    color:#eab676; 
    border:2px solid #eab676; 
    padding:10px 20px; 
    border-radius:25px;
    font-size:20px;
    text-decoration:none;
    transition:0.3s;
}

.hero-btn a:hover {
    background:#eab676;
    color:black;
}

/* CATEGORY CARDS */
.category-container {
    width:80%;
    margin:40px auto;
    display:flex;
    flex-direction:column; /* ustma-ust */
    gap:20px;
}

.category-card {
    background: linear-gradient(145deg, rgba(0,0,0,0.7), rgba(50,50,50,0.7));
    border:2px solid #eab676;
    border-radius:15px;
    padding:25px;
    text-align:center;
    cursor:pointer;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.5);
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(234,182,118,0.5);
}

.category-card h2 {
    color:#ffd59e;
    font-size:28px;
    margin:0;
    font-family: 'Poppins', sans-serif;
}

/* POPUP */
.item-popup {
    display:none;
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.85);
    padding-top:50px;
    z-index:100;
}

.popup-box {
    width:80%;
    margin:auto;
    background: linear-gradient(145deg, #1c1c1c, #2a2a2a);
    border:2px solid #eab676;
    border-radius:15px;
    padding:20px;
    max-height:80vh;
    overflow-y:auto;
}

.close-btn {
    float:right;
    padding:8px 12px;
    background:#eab676;
    color:black;
    border:none;
    font-weight:bold;
    cursor:pointer;
    border-radius:10px;
}

.item-card {
    display:flex;
    background: rgba(255,255,255,0.05);
    margin:15px 0;
    padding:15px;
    border-radius:10px;
    border:1px solid #eab676;
}

.item-card img {
    width:120px;
    height:120px;
    border-radius:10px;
    margin-right:15px;
}

.item-info h3 {
    margin:0;
    color:#ffd59e;
    font-family: 'Poppins', sans-serif;
}

.item-info p {
    margin:5px 0;
}

.btn {
    padding:8px 15px;
    background: linear-gradient(90deg,#c28a52,#eab676);
    color:white;
    border:none;
    border-radius:8px;
    font-size:15px;
    font-weight:bold;
    cursor:pointer;
}

.btn:hover {
    background: linear-gradient(90deg,#eab676,#c28a52);
}
</style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <a onclick="toggleSignLinks()">Sign In</a>
</div>

<!-- SIGN IN DROPDOWN -->
<div id="sign-links">
    <a href="userlogin.php">User Login</a>
    <a href="signup.php">Sign Up</a>
    <a href="feedback.php">Feedback</a>
    <a href="adminlogin.php">Admin Login</a>
</div>

<script>
function toggleSignLinks(){
    let x = document.getElementById("sign-links");
    x.style.display = (x.style.display==="none") ? "flex" : "none";
}
</script>

<!-- HERO -->
<div class="hero" id="hero-section">
    <div class="hero-content">
        <h1>Welcome to <span>Restaurant</span></h1>
        <p>Delivering great food for more than 18 years!</p>
        <div class="hero-btn">
            <a href="#" onclick="showCategories()">OUR MENU</a>
        </div>
    </div>
</div>

<!-- CATEGORY PAGE -->
<div id="categories" style="display:none;">
    <h1 class="menu-title" style="text-align:center; margin-top:30px;">Fast Food Categories</h1>
    <div class="category-container">
        <div class="category-card" onclick="openPopup('Pizza')"><h2>🍕 Pizza</h2></div>
        <div class="category-card" onclick="openPopup('Burger')"><h2>🍔 Burger</h2></div>
        <div class="category-card" onclick="openPopup('Lavash')"><h2>🌯 Lavash</h2></div>
        <div class="category-card" onclick="openPopup('Sandwich')"><h2>🥪 Sandwich</h2></div>
        <div class="category-card" onclick="openPopup('Drinks')"><h2>🥤 Drinks</h2></div>
    </div>
</div>

<!-- POPUP -->
<div id="popup" class="item-popup">
    <div class="popup-box">
        <button class="close-btn" onclick="closePopup()">X</button>
        <h2 id="popup-title" style="text-align:center; color:#ffd59e;"></h2>
        <div id="popup-items"></div>
    </div>
</div>

<script>
function showCategories(){
    document.getElementById("hero-section").classList.add("hidden");
    document.getElementById("categories").style.display = "block";
}

function openPopup(category){
    document.getElementById("popup").style.display="block";
    document.getElementById("popup-title").innerText = category;

    let itemsHTML = "";

    <?php
        $sql = "SELECT * FROM menu ORDER BY category";
        $res = mysqli_query($connection,$sql);
        $foods = [];

        while($r = mysqli_fetch_assoc($res)){
            $foods[$r['category']][] = $r;
        }

        echo "let foodData = " . json_encode($foods) . ";";
    ?>

    // Agar Pizza bo'lsa 6 ta item qo'shish
    if(category === 'Pizza'){
        if(foodData['Pizza']){
            foodData['Pizza'].slice(0,6).forEach(item => {
                itemsHTML += `
                <div class="item-card">
                    <img src="images/${item.image}">
                    <div class="item-info">
                        <h3>${item.name}</h3>
                        <p>${item.description}</p>
                        <p><b>${item.price} so'm</b></p>
                        <form action="add_order.php" method="POST">
                            <input type="hidden" name="item_id" value="${item.id}">
                            <button class="btn">Add to Order</button>
                        </form>
                    </div>
                </div>`;
            });
        }
    } else if(foodData[category]){
        foodData[category].forEach(item => {
            itemsHTML += `
            <div class="item-card">
                <img src="images/${item.image}">
                <div class="item-info">
                    <h3>${item.name}</h3>
                    <p>${item.description}</p>
                    <p><b>${item.price} so'm</b></p>
                    <form action="add_order.php" method="POST">
                        <input type="hidden" name="item_id" value="${item.id}">
                        <button class="btn">Add to Order</button>
                    </form>
                </div>
            </div>`;
        });
    }

    document.getElementById("popup-items").innerHTML = itemsHTML;
}

function closePopup(){
    document.getElementById("popup").style.display="none";
}
</script>

</body>
</html>







