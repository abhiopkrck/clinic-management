<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<style>.export-btn {
    background-color: #28a745;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s;
}

.export-btn:hover {
    background-color: #218838;
}

</style>
<div class="container">
    <h2>📤 Export Data</h2>
    <p>Click below to export patient records as CSV:</p>

    <a href="export_patients.php" class="export-btn">Export Patients CSV</a>

    <br><br>
    <a class="back" href="../auth/dashboard.php">← Back to Dashboard</a>
</div>
