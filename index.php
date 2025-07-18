<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clinic Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color:rgb(123, 130, 192);
        }
    
        .hero {
            background: url('images/clinic-banner.jpg') no-repeat center center;
            background-size: cover;
            height: 400px;
            color: white;
            text-align: center;
            padding-top: 150px;
            font-size: 2em;
        }
        .nav-link {
            font-weight: bold;
        }
        .card {
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">ClinicSys</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="auth/login.php">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="auth/register.php">Register</a></li>
            <li class="nav-item"><a class="nav-link" href="appointments/book_appointment.php">Appointments</a></li>
            <li class="nav-item"><a class="nav-link" href="patients/add_patient.php">Patients</a></li>
            <li class="nav-item"><a class="nav-link" href="medicines/">Medicines</a></li>
            <li class="nav-item"><a class="nav-link" href="pharmacy/">Pharmacy</a></li>
        </ul>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero">
    <h1>Welcome to Our Clinic</h1>
    <p>Your health, our priority</p>
</div>

<!-- Features -->
<div class="container mt-5">
    <h2 class="text-center mb-4">System Modules</h2>
    <div class="row">
        <div class="col-md-4">
            <a href="appointments/" class="text-decoration-none text-dark">
                <div class="card p-3">
                    <img src="https://th.bing.com/th?q=Appointment+Icon.png&w=120&h=120&c=1&rs=1&qlt=70&o=7&cb=1&pid=InlineBlock&rm=3&mkt=en-IN&cc=IN&setlang=en&adlt=moderate&t=1&mw=247" class="card-img-top" alt="Appointments">
                    <div class="card-body">
                        <h5 class="card-title">Appointments</h5>
                        <p class="card-text">Book and manage doctor appointments.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="patients/" class="text-decoration-none text-dark">
                <div class="card p-3">
                    <img src="https://th.bing.com/th/id/OIP.wUyzCFbHIGFJSJykAKs_XwHaE8?w=256&h=180&c=7&r=0&o=7&pid=1.7&rm=3" class="card-img-top" alt="Patients">
                    <div class="card-body">
                        <h5 class="card-title">Patients</h5>
                        <p class="card-text">Add, edit, and view patient records.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="pharmacy/" class="text-decoration-none text-dark">
                <div class="card p-3">
                    <img src="https://th.bing.com/th/id/OIP.1nylXB0FDQ5ni78hwqftLQHaEK?w=284&h=180&c=7&r=0&o=7&pid=1.7&rm=3" class="card-img-top" alt="Pharmacy">
                    <div class="card-body">
                        <h5 class="card-title">Pharmacy</h5>
                        <p class="card-text">View prescriptions and manage medicines.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

</body>
</html>
