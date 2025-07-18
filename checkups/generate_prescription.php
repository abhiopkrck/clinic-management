<?php include('../db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Prescriptions</title>
      <style>
/* General layout */
body {
    font-family: Arial, sans-serif;
    background: #f3f6fb;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    max-width: 700px;
    margin: 30px auto;
    background: #ffffff;
    padding: 25px 30px;
    border-radius: 10px;
    box-shadow: 0 0 12px rgba(0,0,0,0.08);
}

h2 {
    margin-bottom: 20px;
    color: #333;
    border-bottom: 2px solid #4CAF50;
    padding-bottom: 5px;
}

/* Form styling */
form label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

form input[type="text"],
form input[type="number"],
form textarea,
form select {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

form textarea {
    resize: vertical;
    min-height: 60px;
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

/* Table styling */
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

/* Success & link styles */
.success {
    background-color: #d4edda;
    color: #155724;
    padding: 12px;
    margin-top: 15px;
    border-radius: 6px;
    border: 1px solid #c3e6cb;
}

a.back {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #4CAF50;
    font-weight: bold;
}

a.back:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
<div class="container">
<h2>All Prescriptions</h2>
<table>
    <tr><th>Patient</th><th>Medicine</th><th>Dosage</th><th>Duration</th></tr>
    <?php
    $sql = "SELECT p.name AS patient_name, pr.*
            FROM prescriptions pr
            JOIN checkups c ON pr.checkup_id = c.checkup_id
            JOIN patients p ON c.patient_id = p.patient_id
            ORDER BY pr.prescription_id DESC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) 
    {
        echo "<tr>
                <td>{$row['patient_name']}</td>
                <td>{$row['medicine_name']}</td>
                <td>{$row['dosage']}</td>
                <td>{$row['duration']}</td>
              </tr>";
    }
    ?>
</table>
<a href="bill.php" class="back">View Bills</a>
</div>
</body>
</html>
