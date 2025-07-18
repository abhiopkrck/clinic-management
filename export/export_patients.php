<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized access.");
}

$conn = new mysqli("localhost", "root", "", "clinic_db");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=patients_export.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Name', 'Age', 'Gender', 'Contact']);

$result = $conn->query("SELECT id, name, age, gender, contact FROM patients");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
