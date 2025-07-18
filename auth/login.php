<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clinic_db");

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($userId, $hashedPassword, $role);
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user_id"] = $userId;
            $_SESSION["role"] = $role;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid credentials.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
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
<h2>Login</h2>
<?php if ($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>
</div>
