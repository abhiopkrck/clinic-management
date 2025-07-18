<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clinic_db");
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $otp = rand(100000, 999999);
        $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));
        $conn->query("UPDATE users SET otp_code='$otp', otp_expiry='$expiry' WHERE email='$email'");
        include 'send_mail.php';
        if (sendOTP($email, $otp)) {
            $_SESSION['reset_email'] = $email;
            header("Location: verify_otp.php");
            exit;
        } else {
            $message = "Failed to send OTP.";
        }
    } else {
        $message = "Email not found.";
    }
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
    <h2>Forgot Password</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required><br>
        <button type="submit">Send OTP</button>
    </form>
    <?php if ($message) echo "<p class='msg'>$message</p>"; ?>
</div>
