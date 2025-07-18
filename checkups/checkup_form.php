<?php include('../db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkup Form</title>
      <style>
/* General layout */
body {
    font-family: Arial, sans-serif;
    background: #f3f6fb;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    max-width: 700px;
    margin: 30px auto;
    background: #ffffff;
    padding: 25px 30px;
    border-radius: 10px;
    box-shadow: 0 0 12px rgba(0,0,0,0.08);
}

h2 {
    margin-bottom: 20px;
    color: #333;
    border-bottom: 2px solid #4CAF50;
    padding-bottom: 5px;
}

/* Form styling */
form label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

form input[type="text"],
form input[type="number"],
form textarea,
form select {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

form textarea {
    resize: vertical;
    min-height: 60px;
}

form button {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 10px 16px;
    font-size: 15px;
    border-radius: 5px;
    cursor: pointer;
}

form button:hover {
    background: #45a049;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

table, th, td {
    border: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    text-align: left;
}

td {
    padding: 8px;
    background-color: #f9f9f9;
}

/* Success & link styles */
.success {
    background-color: #d4edda;
    color: #155724;
    padding: 12px;
    margin-top: 15px;
    border-radius: 6px;
    border: 1px solid #c3e6cb;
}

a.back {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #4CAF50;
    font-weight: bold;
}

a.back:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
<div class="container">
<h2>New Patient Checkup</h2>

<form method="POST">
    <label>Select Patient:</label>
    <select name="patient_id" required>
        <option value="">-- Choose --</option>
        <?php
        $patients = $conn->query("SELECT * FROM patients");
        while ($p = $patients->fetch_assoc()) {
            echo "<option value='{$p['patient_id']}'>{$p['name']}</option>";
        }
        ?>
    </select>

    <label>Symptoms:</label>
    <textarea name="symptoms" required></textarea>

    <label>Diagnosis:</label>
    <textarea name="diagnosis" required></textarea>

    <label>Medicines (comma-separated):</label>
    <input type="text" name="medicines" placeholder="Paracetamol, Amoxicillin" required>

    <label>Consultation Fee:</label>
    <input type="number" name="consultation_fee" required>

    <button type="submit" name="submit">Submit Checkup</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $patient_id = $_POST['patient_id'];
    $symptoms = $_POST['symptoms'];
    $diagnosis = $_POST['diagnosis'];
    $consult_fee = $_POST['consultation_fee'];
    $medicines = explode(",", $_POST['medicines']);
    $today = date("Y-m-d");

    // Save checkup
    $conn->query("INSERT INTO checkups (patient_id, symptoms, diagnosis, date)
                  VALUES ($patient_id, '$symptoms', '$diagnosis', '$today')");
    $checkup_id = $conn->insert_id;

    // Save prescription
    foreach ($medicines as $med) {
        $m = trim($med);
        $conn->query("INSERT INTO prescriptions (checkup_id, medicine_name, dosage, duration)
                      VALUES ($checkup_id, '$m', '1 tab', '5 days')");
    }

    // Total medicine cost (fake flat rate for now)
    $medicine_fee = count($medicines) * 50;

    // Save billing
    $total = $medicine_fee + $consult_fee;
    $conn->query("INSERT INTO billing (patient_id, consultation_fee, medicine_fee, total_amount)
                  VALUES ($patient_id, $consult_fee, $medicine_fee, $total)");

    echo "<p class='success'>Checkup recorded, prescription and bill created.</p>";
}
?>
<a href="generate_prescription.php" class="back">View Prescriptions</a>
</div>
</body>
</html>
