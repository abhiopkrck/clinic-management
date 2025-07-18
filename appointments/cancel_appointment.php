<?php include('../db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("UPDATE appointments SET status = 'Canceled' WHERE appointment_id = $id");
}
header("Location: view_appointments.php");
?>
