
<?php
$conn = new mysqli("localhost", "root", "", "clinic_db");
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, role, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $role, $password);
    $stmt->execute();

    $msg = "User added successfully!";
}
?>

<style>.button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 16px;
    text-decoration: none;
    border-radius: 6px;
    margin-bottom: 15px;
    display: inline-block;
    font-weight: bold;
}

.button:hover {
    background-color: #388e3c;
}
</style>
<div class="container">
    <h2>Add New User</h2>
    <?php if ($msg): ?><div class="success"><?= $msg ?></div><?php endif; ?>
    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Role</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="doctor">Doctor</option>
            <option value="receptionist">Receptionist</option>
            <option value="pharmacist">Pharmacist</option>
        </select>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Add User</button>
    </form>
    <a href="manage_users.php" class="back">← Back to User List</a>
</div>
