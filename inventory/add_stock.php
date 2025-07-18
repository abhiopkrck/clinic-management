<?php include('../db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Inventory</title>
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
<h2>Add Medicine Stock</h2>
<form method="POST">
    <label>Select Medicine:</label>
    <select name="medicine_id" required>
        <option value="">Select</option>
        <?php
        $res = $conn->query("SELECT * FROM medicines");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['medicine_id']}'>{$row['name']}</option>";
        }
        ?>
    </select>

    <label>Batch No:</label>
    <input type="text" name="batch_number" required>

    <label>Expiry Date:</label>
    <input type="date" name="expiry_date" required>

    <label>Stock Quantity:</label>
    <input type="number" name="stock" required>

    <button type="submit" name="save">Add Stock</button>
</form>

<?php
if (isset($_POST['save'])) {
    $mid = $_POST['medicine_id'];
    $batch = $_POST['batch_number'];
    $exp = $_POST['expiry_date'];
    $qty = $_POST['stock'];
    $conn->query("INSERT INTO inventory (medicine_id, batch_number, expiry_date, stock)
                  VALUES ($mid, '$batch', '$exp', $qty)");
    echo "<p class='success'>Stock added.</p>";
}
?>
<a href="view_inventory.php" class="back">View Inventory</a>
</div>
</body>
</html>

