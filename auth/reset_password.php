<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clinic_db");
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_SESSION['reset_email'];
    $conn->query("UPDATE users SET password='$pass', otp_code=NULL, otp_expiry=NULL WHERE email='$email'");
    unset($_SESSION['reset_email']);
    $message = "Password updated. <a href='login.php'>Login now</a>";
}
?>

<style>.container {
    max-width: 400px;
    margin: 30px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 12px;
    background: #fafafa;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 15px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    padding: 10px;
    background: #2c3e50;
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #34495e;
}

.msg {
    margin-top: 10px;
    text-align: center;
    color: red;
}
</style>
<div class="container">
    <h2>Reset Password</h2>
    <form method="POST">
        <input type="password" name="password" placeholder="New password" required><br>
        <button type="submit">Reset Password</button>
    </form>
    <?php if ($message) echo "<p class='msg'>$message</p>"; ?>
</div>
