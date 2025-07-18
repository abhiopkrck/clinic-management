<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION["role"];
?>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #e8f0fe;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 450px;
    margin: 60px auto;
    background-color: #ffffff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333333;
    margin-bottom: 25px;
}

form label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
    color: #444;
}

form input[type="text"],
form input[type="password"],
form input[type="email"],
form select {
    width: 100%;
    padding: 12px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    box-sizing: border-box;
}

form button {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #388e3c;
}

.success, .error {
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    font-weight: bold;
}

.success {
    background-color: #d4edda;
    color: #155724;
    border-left: 5px solid #28a745;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    border-left: 5px solid #dc3545;
}

a.back {
    display: inline-block;
    margin-top: 20px;
    text-align: center;
    color: #4CAF50;
    font-weight: bold;
    text-decoration: none;
}

a.back:hover {
    text-decoration: underline;
}

/* Dashboard Links */
ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    background: #f1f1f1;
    margin: 8px 0;
    padding: 10px 15px;
    border-radius: 6px;
    transition: 0.3s ease;
}

ul li a {
    color: #333;
    font-weight: 500;
    text-decoration: none;
    display: block;
}

ul li:hover {
    background-color: #e0f7fa;
}

</style>
<div class="container">
    <h2>Welcome, <?= ucfirst($role) ?></h2>

    <ul>
        <?php if ($role === 'admin'): ?>
            <li><a href="../patients/view.php">Manage Patients</a></li>
            <li><a href="../medicines/view.php">Manage Medicines</a></li>
            <li><a href="../inventory/view.php">Inventory</a></li>
            <li><a href="../branches/view.php">Branches</a></li>
        <?php elseif ($role === 'doctor'): ?>
            <li><a href="../checkups/checkup.php">Checkups</a></li>
            <li><a href="../prescriptions/view.php">Prescriptions</a></li>
        <?php elseif ($role === 'receptionist'): ?>
            <li><a href="../appointments/view.php">Appointments</a></li>
            <li><a href="../pharmacy/dispense.php">Dispense Medicines</a></li>
        <?php endif; ?>
    </ul>

    <a href="logout.php" class="back">Logout</a>
</div>
