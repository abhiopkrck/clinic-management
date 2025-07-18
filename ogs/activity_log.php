<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "clinic_db");

// Fetch logs
$logs = $conn->query("SELECT * FROM activity_logs ORDER BY timestamp DESC");
?>

<style>.container {
    max-width: 900px;
    margin: 30px auto;
    padding: 20px;
    background: #fefefe;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
}

h2 {
    color: #2c3e50;
    border-bottom: 2px solid #ccc;
    padding-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ccc;
    text-align: left;
    font-size: 14px;
}

table tr:nth-child(even) {
    background: #f9f9f9;
}

.back {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color: #2c3e50;
    font-weight: bold;
}

</style>
<div class="container">
    <h2>Activity Logs</h2>

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Role</th>
                <th>Action</th>
                <th>Module</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($log = $logs->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($log['username']) ?></td>
                    <td><?= htmlspecialchars($log['role']) ?></td>
                    <td><?= htmlspecialchars($log['action']) ?></td>
                    <td><?= htmlspecialchars($log['module']) ?></td>
                    <td><?= $log['timestamp'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="../auth/dashboard.php" class="back">← Back to Dashboard</a>
</div>
