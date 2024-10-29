<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicio - Contact Us</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

<!-- Navbar -->
<?php include 'nav.php'; ?>

<!-- Contact Section -->
<div class="container my-5">
    <h2 class="text-center text-primary mb-5">Contact Us</h2>
    <div class="row">
        <div class="col-lg-6">
            <h5 class="text-primary mb-3">Get in Touch</h5>
            <p>For any queries or appointments, feel free to reach out to us. We're here to help!</p>
            <ul class="list-unstyled">
                <li><strong>Phone:</strong> +1 234 567 890</li>
                <li><strong>Email:</strong> info@medicio.com</li>
                <li><strong>Address:</strong> 123 Medical Street, Healthcare City</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Your Email">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Your Message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
