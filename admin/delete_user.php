<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "clinic_db");
$id = intval($_GET['id']);

$conn->query("DELETE FROM users WHERE id=$id");
header("Location: manage_users.php");
?>
