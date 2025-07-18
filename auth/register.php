<?php
// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "clinic_db"; // Use your DB name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
     $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password

    // Prepare SQL
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Prepare failed: " . $conn->error); // Debug SQL error
    }

    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
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
<h2>Register User</h2>
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <label>Role:</label>
    <select name="role">
        <option value="admin">Admin</option>
        <option value="doctor">Doctor</option>
        <option value="receptionist">Receptionist</option>
    </select>
    <button type="submit">Register</button>
</form>
</div>
