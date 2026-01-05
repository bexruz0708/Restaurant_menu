<?php
// config.php faylini ulash
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="style.css"> <!-- agar style.css ishlatilsa -->
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        a { text-decoration: none; color: #007BFF; }
        a:hover { text-decoration: underline; }
        .btn { padding: 5px 10px; background-color: #28a745; color: white; border-radius: 4px; }
        .btn:hover { background-color: #218838; }
    </style>
</head>
<body>

<h1>Restaurant Menu</h1>

<?php
// Menu jadvalidan barcha itemlarni olish
$sql = "SELECT * FROM menu";
$result = mysqli_query($connection, $sql);

if(mysqli_num_rows($result) > 0){
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Action</th></tr>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>". $row['id'] ."</td>";
        echo "<td>". $row['name'] ."</td>";
        echo "<td>". $row['description'] ."</td>";
        echo "<td>$". $row['price'] ."</td>";
        echo "<td>
                <form action='add_order.php' method='POST' style='margin:0;'>
                    <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                    <button type='submit' class='btn'>Add to Order</button>
                </form>
              </td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>Menu is empty.</p>";
}
?>

<div class="links">
    <a href="feedback.php">Leave Feedback</a> | 
    <a href="login.php">Admin Login</a>
</div>

</body>
</html>

