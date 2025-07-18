<?php
// Step 1: Connect to database
$conn = new mysqli("localhost", "root", "", "clinic");

// Step 2: Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Define SQL query
$sql = "SELECT 
            a.appointment_id, 
            p.name AS patient_name, 
            a.doctor_name, 
            a.appointment_date, 
            a.status 
        FROM appointments a
        JOIN patients p ON a.patient_id = p.patient_id";

// Step 4: Execute query and check result
$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);  // Show error clearly
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Appointments</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f0f9ff;
        }
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #0077b6;
            color: white;
        }
        a {
            text-decoration: none;
            color: #0077b6;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Appointment List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['appointment_id']; ?></td>
                <td><?= $row['patient_name']; ?></td>
                <td><?= $row['doctor_name']; ?></td>
                <td><?= $row['appointment_date']; ?></td>
                <td><?= $row['status']; ?></td>
                <td>
                    <a href="edit_appointment.php?id=<?= $row['appointment_id']; ?>">Edit</a> |
                    <a href="delete_appointment.php?id=<?= $row['appointment_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>