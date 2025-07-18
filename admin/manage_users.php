<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "clinic_db");

$users = $conn->query("SELECT * FROM users");
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
    <h2>User Management</h2>
    <a href="add_user.php" class="button">+ Add New User</a>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td>
                    <a href="edit_user.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete user?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="../auth/dashboard.php" class="back">← Back to Dashboard</a>
</div>
