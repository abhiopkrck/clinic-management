<?php include('../db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Medicine</title>
   <style>/* === General Layout === */
body {
    font-family: Arial, sans-serif;
    background: #f3f6fb;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    max-width: 720px;
    margin: 30px auto;
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
    color: #333;
    border-bottom: 2px solid #4CAF50;
    padding-bottom: 8px;
}

/* === Form Styles === */
form label {
    display: block;
    margin: 12px 0 5px;
    font-weight: bold;
}

form input[type="text"],
form input[type="number"],
form textarea,
form select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

form button {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 10px 16px;
    font-size: 15px;
    border-radius: 5px;
    cursor: pointer;
}

form button:hover {
    background: #45a049;
}

/* === Table Styles === */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

table, th, td {
    border: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    text-align: left;
}

td {
    padding: 8px;
    background-color: #f9f9f9;
}

/* === Message & Navigation Styles === */
.success {
    background-color: #d4edda;
    color: #155724;
    padding: 12px;
    margin-top: 15px;
    border-radius: 6px;
    border: 1px solid #c3e6cb;
}

a.back, a {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #4CAF50;
    font-weight: bold;
}

a.back:hover, a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
<div class="container">
<h2>Add New Medicine</h2>

<form method="POST">
    <label>Medicine Name:</label>
    <input type="text" name="name" required>

    <label>Quantity:</label>
    <input type="number" name="quantity" required>

    <label>Price per Unit:</label>
    <input type="number" name="price" required>

    <button type="submit" name="add">Add Medicine</button>
</form>

<?php
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];

    $conn->query("INSERT INTO medicines (name, quantity, price) VALUES ('$name', $qty, $price)");
    echo "<p class='success'>Medicine added successfully.</p>";
}
?>

<a href="view_medicines.php" class="back">View Medicines</a>
</div>
</body>
</html>
