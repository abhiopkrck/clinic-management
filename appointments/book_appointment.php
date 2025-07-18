<?php include('../db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
<h2>Book New Appointment</h2>

<form method="POST">
    <label>Patient:</label>
    <select name="patient_id" required>
        <option value="">-- Select Patient --</option>
        <?php
        $patients = $conn->query("SELECT patient_id, name FROM patients");
        while ($p = $patients->fetch_assoc()) {
            echo "<option value='{$p['patient_id']}'>{$p['name']}</option>";
        }
        ?>
    </select>

    <label>Doctor Name:</label>
    <input type="text" name="doctor_name" required>

    <label>Date:</label>
    <input type="date" name="appointment_date" required>

    <button type="submit" name="book">Book Appointment</button>
</form>

<?php
if (isset($_POST['book'])) {
    $patient_id = $_POST['patient_id'];
    $doctor = $_POST['doctor_name'];
    $date = $_POST['appointment_date'];

    $sql = "INSERT INTO appointments (patient_id, doctor_name, appointment_date, status)
            VALUES ($patient_id, '$doctor', '$date', 'Scheduled')";
    if ($conn->query($sql)) {
        echo "<p class='success'>Appointment booked successfully.</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>

<a href="view_appointments.php" class="back">View Appointments</a>
</div>
</body>
</html>
