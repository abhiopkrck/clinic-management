
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "clinic_db");
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $otp = $_POST['otp'];
    $email = $_SESSION['reset_email'];
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND otp_code='$otp' AND otp_expiry >= NOW()");
    if ($result->num_rows > 0) {
        header("Location: reset_password.php");
        exit;
    } else {
        $message = "Invalid or expired OTP.";
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
    <h2>Verify OTP</h2>
    <form method="POST">
        <input type="text" name="otp" placeholder="Enter OTP" required><br>
        <button type="submit">Verify</button>
    </form>
    <?php if ($message) echo "<p class='msg'>$message</p>"; ?>
</div>
