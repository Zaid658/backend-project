<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicio - Your Health Partner</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

<?php include 'nav.php' ?>

<!-- Hero Section -->
<div class="container-fluid bg-light py-5">
    <div class="container text-center">
        <h1 class="display-4 text-primary">Welcome to Medicio</h1>
        <p class="lead mt-3">Providing expert healthcare with compassion, dedication, and innovation. Your health is our priority.</p>
        <a href="appointment.php" class="btn btn-primary btn-lg mt-3">Book an Appointment</a>
    </div>
</div>
<?php include 'displaycaro.php' ?>
<!-- Services Section -->
<div class="container my-5">
    <h2 class="text-center text-primary mb-5">Our Services</h2>
    <div class="row">
        <div class="col-lg-4 text-center mb-4">
            <img src="img/download (1).jpeg" alt="General Checkup" class="rounded-circle mb-3" width="190" height="150">
            <h5 class="mb-3">General Checkup</h5>
            <p>Routine health exams to keep you at your best.</p>
        </div>
        <div class="col-lg-4 text-center mb-4">
            <img src="img/download.jpeg" alt="Specialist Consultation" class="rounded-circle mb-3" width="190" height="150">
            <h5 class="mb-3">Specialist Consultation</h5>
            <p>Consult with top specialists in various fields.</p>
        </div>
        <div class="col-lg-4 text-center mb-4">
            <img src="img/Emergency-Services-in-Pakistan-H-26-03-1024x640.jpg" alt="Emergency Services" class="rounded-circle mb-3" width="190" height="150">
            <h5 class="mb-3">Emergency Services</h5>
            <p>24/7 emergency medical care.</p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-4">
    <div class="container">
        <p class="mb-0">© 2024 Medicio. Your health, our priority.</p>
        <p>Contact: +1 234 567 890 | Email: info@medicio.com</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
