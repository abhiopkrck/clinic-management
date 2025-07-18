<?php include('../db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>All Medicines</title>
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
<h2>Medicine List</h2>
<a href="add_medicine.php" class="back">➕ Add New</a>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Quantity</th><th>Price</th><th>Actions</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM medicines");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['medicine_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['quantity']}</td>
            <td>₹{$row['price']}</td>
            <td>
                <a href='edit_medicine.php?id={$row['medicine_id']}'>Edit</a> |
                <a href='delete_medicine.php?id={$row['medicine_id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
            </td>
        </tr>";
    }
    ?>
</table>
</div>
</body>
</html>
