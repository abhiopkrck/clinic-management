<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = ""; // default for XAMPP
$dbname = "clinic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all patients
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Patients</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 20px; }
        table { border-collapse: collapse; width: 80%; margin: auto; background: white; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        h2 { text-align: center; }
        body {
    font-family: Arial;
    background: #add8e6; /* Light Blue background */
    padding: 20px;
}

table {
    border-collapse: collapse;
    width: 80%;
    margin: auto;
    background: white;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

th {
    background-color: #4CAF50;
    color: white;
}

h2 {
    text-align: center;
}
 body {
        font-family: 'Orbitron', sans-serif;
        background-color:rgb(152, 215, 241);
        color: #fff;
        padding: 40px;
    }

    h2 {
        text-align: center;
        color:rgb(0, 0, 0);
        text-shadow: 0 0 5px #00ffe1;
        margin-bottom: 30px;
    }

    table {
        width: 90%;
        margin: auto;
        border-collapse: collapse;
        background: #1a1a1a;
        box-shadow: 0 0 15px #00ffe1;
        border-radius: 12px;
        overflow: hidden;
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #333;
        transition: background 0.3s;
    }

    th {
        background: #222;
        color: #00ffe1;
        font-size: 18px;
        border-bottom: 2px solid #00ffe1;
    }

    td {
        color: #f0f0f0;
    }

    tr:hover {
        background:rgb(219, 169, 156);
    }

    a {
        color: #00ffe1;
        text-decoration: none;
        transition: 0.3s;
    }

    a:hover {
        color: #ff00d4;
        text-shadow: 0 0 5px #ff00d4;
    }
    </style>
</head>
<body>
    <h2>Patients List</h2>
 <table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Contact</th>
        <th>Actions</th> <!-- Add Actions column -->
    </tr>

    <?php
    $conn = new mysqli("localhost", "root", "", "clinic");
    $sql = "SELECT * FROM patients";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['age']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['contact']."</td>";
        
        // ✅ Add the Edit and Delete links:
        echo "<td>
                <a href='edit_patient.php?id=".$row['id']."'>Edit</a> | 
                <a href='delete_patient.php?id=".$row['id']."' onclick=\"return confirm('Are you sure?');\">Delete</a>
              </td>";

        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
