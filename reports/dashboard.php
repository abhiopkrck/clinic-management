<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "clinic_db");

// Get counts for summary
$patients = $conn->query("SELECT COUNT(*) as total FROM patients")->fetch_assoc()['total'];
$appointments = $conn->query("SELECT COUNT(*) as total FROM appointments")->fetch_assoc()['total'];
$checkups = $conn->query("SELECT COUNT(*) as total FROM checkups")->fetch_assoc()['total'];
$medicines = $conn->query("SELECT COUNT(*) as total FROM medicines")->fetch_assoc()['total'];
$income = $conn->query("SELECT SUM(total_amount) as total FROM billing")->fetch_assoc()['total'];
?>

<style>
.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    margin-top: 25px;
}

.card {
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease;
}

.card:hover {
    transform: scale(1.05);
}

.card h3 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #333;
}

.card p {
    font-size: 24px;
    font-weight: bold;
    color: #4CAF50;
}
</style>
<div class="container">
    <h2>Clinic Reports Dashboard</h2>

    <div class="card-grid">
        <div class="card">
            <h3>Total Patients</h3>
            <p><?= $patients ?></p>
        </div>
        <div class="card">
            <h3>Appointments</h3>
            <p><?= $appointments ?></p>
        </div>
        <div class="card">
            <h3>Checkups</h3>
            <p><?= $checkups ?></p>
        </div>
        <div class="card">
            <h3>Medicines</h3>
            <p><?= $medicines ?></p>
        </div>
        <div class="card">
            <h3>Total Income</h3>
            <p>₹<?= number_format($income, 2) ?></p>
        </div>
    </div>

    <a href="../auth/dashboard.php" class="back">← Back to Dashboard</a>
</div>
