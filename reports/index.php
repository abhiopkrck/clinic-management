<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "clinic_db");

// Set date range
$from = $_GET['from'] ?? date('Y-m-d', strtotime('-7 days'));
$to = $_GET['to'] ?? date('Y-m-d');

// Revenue summary
$billing = $conn->query("SELECT SUM(amount) AS total FROM billing WHERE date BETWEEN '$from' AND '$to'");
$pharmacy = $conn->query("SELECT SUM(total_price) AS total FROM pharmacy_billing WHERE date BETWEEN '$from' AND '$to'");
$appointments = $conn->query("SELECT COUNT(*) AS total FROM appointments WHERE DATE(datetime) BETWEEN '$from' AND '$to'");

// Top medicines
$top_meds = $conn->query("
    SELECT m.name, COUNT(p.medicine_id) as count 
    FROM prescriptions p
    JOIN medicines m ON p.medicine_id = m.id
    WHERE p.date BETWEEN '$from' AND '$to'
    GROUP BY p.medicine_id
    ORDER BY count DESC
    LIMIT 5
");
?>

<style>
.form-inline {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.summary ul {
    list-style: none;
    padding: 0;
}

.summary li {
    margin-bottom: 8px;
    font-size: 16px;
}
</style>
<div class="container">
    <h2>Clinic Reports</h2>

    <form method="get" class="form-inline">
        <label>From:</label>
        <input type="date" name="from" value="<?= $from ?>" required>
        <label>To:</label>
        <input type="date" name="to" value="<?= $to ?>" required>
        <button type="submit">Filter</button>
    </form>

    <div class="summary">
        <h3>Summary (<?= $from ?> to <?= $to ?>)</h3>
        <ul>
            <li><strong>Total Appointments:</strong> <?= $appointments->fetch_assoc()['total'] ?></li>
            <li><strong>Total Consultation Revenue:</strong> ₹<?= $billing->fetch_assoc()['total'] ?? 0 ?></li>
            <li><strong>Total Pharmacy Revenue:</strong> ₹<?= $pharmacy->fetch_assoc()['total'] ?? 0 ?></li>
        </ul>
    </div>

    <h3>Top 5 Prescribed Medicines</h3>
    <table>
        <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Times Prescribed</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $top_meds->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['count'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="../auth/dashboard.php" class="back">← Back to Dashboard</a>
</div>
