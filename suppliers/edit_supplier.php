
<?php include('../db.php');
$id = $_GET['id'];
$supplier = $conn->query("SELECT * FROM suppliers WHERE supplier_id = $id")->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $conn->query("UPDATE suppliers SET name='$name', contact='$contact', address='$address' WHERE supplier_id=$id");
    header("Location: view_suppliers.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
          <style>/* General Page Style */
body {
    font-family: Arial, sans-serif;
    background: #f3f6fb;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 720px;
    margin: 40px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

/* Heading Style */
h2 {
    border-bottom: 2px solid #4CAF50;
    padding-bottom: 10px;
    margin-bottom: 25px;
    color: #333;
}

/* Form Elements */
form label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="number"],
form input[type="date"],
form input[type="file"],
form select,
form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 18px;
    box-sizing: border-box;
    font-size: 14px;
}

form button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 18px;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    transition: background 0.2s ease;
}

form button:hover {
    background-color: #388e3c;
}

/* Tables */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #4CAF50;
    color: white;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Buttons and Links */
a {
    text-decoration: none;
    color: #4CAF50;
}

a.back {
    display: inline-block;
    margin-top: 20px;
    color: #4CAF50;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

.actions a {
    margin-right: 10px;
    color: #1565c0;
    font-weight: bold;
}

.actions a:hover {
    color: #0d47a1;
}

/* Messages */
.success {
    background-color: #d4edda;
    color: #155724;
    padding: 12px 15px;
    border-left: 5px solid #28a745;
    border-radius: 6px;
    margin-bottom: 15px;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    padding: 12px 15px;
    border-left: 5px solid #dc3545;
    border-radius: 6px;
    margin-bottom: 15px;
}

/* Responsive */
@media (max-width: 600px) {
    .container {
        padding: 20px;
    }

    form input, form select, form textarea, form button {
        font-size: 16px;
    }
}
</style>
</head>
<body>
<div class="container">
<h2>Edit Supplier</h2>
<form method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?= $supplier['name'] ?>" required>

    <label>Contact:</label>
    <input type="text" name="contact" value="<?= $supplier['contact'] ?>" required>

    <label>Address:</label>
    <textarea name="address"><?= $supplier['address'] ?></textarea>

    <button type="submit" name="update">Update</button>
</form>
<a href="view_suppliers.php" class="back">Back</a>
</div>
</body>
</html>
