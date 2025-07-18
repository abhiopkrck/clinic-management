<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "clinic_db");

// Appointments within next 24 hours
$now = date('Y-m-d H:i:s');
$tomorrow = date('Y-m-d H:i:s', strtotime('+1 day'));
$appointments = $conn->query("SELECT * FROM appointments WHERE datetime BETWEEN '$now' AND '$tomorrow'");

// Low stock medicines
$low_stock = $conn->query("SELECT * FROM inventory WHERE quantity < 10");

// Expiring medicines
$today = date('Y-m-d');
$expiring = $conn->query("SELECT * FROM inventory WHERE expiry_date <= DATE_ADD('$today', INTERVAL 7 DAY)");
?>

<style>.container h3 {
    margin-top: 30px;
    color: #444;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
}

table tr:hover {
    background-color: #f9f9f9;
}
</style>
<div class="container">
    <h2>Notifications & Reminders</h2>

    <h3>Upcoming Appointments (Next 24 Hours)</h3>
    <?php if ($appointments->num_rows > 0): ?>
        <table>
            <tr><th>Patient ID</th><th>Doctor ID</th><th>Date & Time</th></tr>
            <?php while ($row = $appointments->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['patient_id'] ?></td>
                    <td><?= $row['doctor_id'] ?></td>
                    <td><?= $row['datetime'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No appointments in the next 24 hours.</p>
    <?php endif; ?>

    <h3>Low Stock Alerts (Less than 10 units)</h3>
    <?php if ($low_stock->num_rows > 0): ?>
        <table>
            <tr><th>Medicine</th><th>Quantity</th></tr>
            <?php while ($row = $low_stock->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['medicine_name'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>All medicine stocks are sufficient.</p>
    <?php endif; ?>

    <h3>Expiring Medicines (Next 7 Days)</h3>
    <?php if ($expiring->num_rows > 0): ?>
        <table>
            <tr><th>Medicine</th><th>Expiry Date</th></tr>
            <?php while ($row = $expiring->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['medicine_name'] ?></td>
                    <td><?= $row['expiry_date'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No expiring medicines in the next week.</p>
    <?php endif; ?>

    <a href="../auth/dashboard.php" class="back">← Back to Dashboard</a>
</div>
