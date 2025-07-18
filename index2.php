<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Hospital - Quality Healthcare Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        header {
            background: #0077cc;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            background: #333;
            color: white;
            padding: 0.5rem;
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        nav ul li {
            margin: 0 1rem;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        .hero {
            background: url('hospital-image.jpg') center/cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 2rem 0;
        }
        .services {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .service-card {
            width: 30%;
            margin-bottom: 2rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 1rem;
        }
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>CITY HOSPITAL</h1>
        <p>Quality Healthcare for All</p>
    </header>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="doctors.php">Doctors</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
    
    <div class="hero">
        <div>
            <h2>Your Health is Our Priority</h2>
            <p>24/7 Emergency Services Available</p>
            <button>Book an Appointment</button>
        </div>
    </div>
    
    <div class="container">
        <h2>Our Services</h2>
        <div class="services">
            <div class="service-card">
                <h3>Emergency Care</h3>
                <p>24/7 emergency services with state-of-the-art facilities.</p>
            </div>
            <div class="service-card">
                <h3>Cardiology</h3>
                <p>Comprehensive heart care from prevention to treatment.</p>
            </div>
            <div class="service-card">
                <h3>Pediatrics</h3>
                <p>Specialized care for infants, children and adolescents.</p>
            </div>
        </div>
    </div>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> City Hospital. All Rights Reserved.</p>
    </footer>
</body>
</html>