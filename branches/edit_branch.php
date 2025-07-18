<?php
include '../db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM branches WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$branch = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $location = $_POST["location"];
    $contact = $_POST["contact"];

    $stmt = $conn->prepare("UPDATE branches SET name=?, location=?, contact=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $location, $contact, $id);
    $stmt->execute();
    header("Location: view_branches.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Branch</title>
      <style>body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f3f6fb;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 750px;
    margin: 50px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
}

/* ======================
   Headings
   ====================== */
h1, h2, h3 {
    color: #333;
    margin-bottom: 20px;
    border-bottom: 2px solid #4CAF50;
    padding-bottom: 8px;
}

/* ======================
   Forms
   ====================== */
form label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
    color: #444;
}

form input[type="text"],
form input[type="number"],
form input[type="date"],
form input[type="file"],
form input[type="email"],
form select,
form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    box-sizing: border-box;
}

form button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s ease;
}

form button:hover {
    background-color: #388e3c;
}

/* ======================
   Tables
   ====================== */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 25px;
    font-size: 14px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

table th {
    background-color: #4CAF50;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

.actions a {
    margin-right: 10px;
    color: #1565c0;
    font-weight: bold;
}

.actions a:hover {
    color: #0d47a1;
}

/* ======================
   Links
   ====================== */
a {
    color: #4CAF50;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

a.back {
    display: inline-block;
    margin-top: 20px;
    font-weight: bold;
}

/* ======================
   Notifications
   ====================== */
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

/* ======================
   Responsive Design
   ====================== */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    form input, form select, form textarea, form button {
        font-size: 16px;
    }

    table {
        font-size: 13px;
    }
}

</style>
</head>
<body>
<div class="container">
    <h2>Edit Branch</h2>
    <form method="post">
        <label>Branch Name:</label>
        <input type="text" name="name" value="<?= $branch['name'] ?>" required>

        <label>Location:</label>
        <input type="text" name="location" value="<?= $branch['location'] ?>" required>

        <label>Contact Info:</label>
        <input type="text" name="contact" value="<?= $branch['contact'] ?>">

        <button type="submit">Update Branch</button>
    </form>
    <a href="view_branches.php" class="back">← Back to Branch List</a>
</div>
</body>
</html>
