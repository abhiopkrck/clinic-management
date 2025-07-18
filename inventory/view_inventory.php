<?php include('../db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
   <style>body {
    font-family: Arial, sans-serif;
    background: #f3f6fb;
}
.container {
    max-width: 720px;
    margin: 30px auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
}
h2 {
    border-bottom: 2px solid #4CAF50;
    padding-bottom: 8px;
    color: #333;
}
form label, form input, form select, form button { /* All styled */ }
table { border-collapse: collapse; width: 100%; }
th, td { padding: 10px; border: 1px solid #ddd; }
.success { background: #d4edda; color: #155724; padding: 12px; }
</style>
</head>
<body>
<div class="container">
<h2>Inventory Stock</h2>
<table>
    <tr><th>Medicine</th><th>Batch</th><th>Expiry</th><th>Stock</th></tr>
    <?php
    $sql = "SELECT i.*, m.name FROM inventory i
            JOIN medicines m ON i.medicine_id = m.medicine_id";
    $res = $conn->query($sql);
    while($row = $res->fetch_assoc()) {
        echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['batch_number']}</td>
            <td>{$row['expiry_date']}</td>
            <td>{$row['stock']}</td>
        </tr>";
    }
    ?>
</table>
</div>
</body>
</html>
