<?php include('../db.php'); ?>
<?php
$id = $_GET['id'];
$appointment = $conn->query("SELECT * FROM appointments WHERE appointment_id = $id")->fetch_assoc();

if (isset($_POST['update'])) {
    $doctor = $_POST['doctor_name'];
    $date = $_POST['appointment_date'];
    $status = $_POST['status'];

    $update = "UPDATE appointments SET doctor_name='$doctor', appointment_date='$date', status='$status'
               WHERE appointment_id=$id";

    if ($conn->query($update)) {
        echo "<p class='success'>Appointment updated.</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
<h2>Edit Appointment</h2>

<form method="POST">
    <label>Doctor Name:</label>
    <input type="text" name="doctor_name" value="<?= $appointment['doctor_name'] ?>" required>

    <label>Date:</label>
    <input type="date" name="appointment_date" value="<?= $appointment['appointment_date'] ?>" required>

    <label>Status:</label>
    <select name="status">
        <option <?= $appointment['status']=='Scheduled'?'selected':'' ?>>Scheduled</option>
        <option <?= $appointment['status']=='Completed'?'selected':'' ?>>Completed</option>
        <option <?= $appointment['status']=='Canceled'?'selected':'' ?>>Canceled</option>
    </select>

    <button type="submit" name="update">Update Appointment</button>
</form>
<a href="view_appointments.php" class="back">Back</a>
</div>
</body>
</html>


