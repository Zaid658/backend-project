<?php
include 'config.php';

$carousel_query = "SELECT * FROM carousel_items";
$carousel_result = mysqli_query($connection, $carousel_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .carousel-item {
            height: 60vh;
            min-height: 300px; 
        }
        .carousel-item img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        .carousel-caption {
            bottom: 20px; 
        }
        .carousel-caption h5 {
            font-size: 2rem; 
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); 
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h3 class="text-center mb-4">Welcome to the Patient Index</h3>
    
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php 
            $first = true;
            while ($carousel = mysqli_fetch_assoc($carousel_result)): 
            ?>
                <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                    <img src="<?php echo $carousel['image']; ?>" class="d-block w-100" alt="<?php echo $carousel['caption']; ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $carousel['caption']; ?></h5>
                    </div>
                </div>
                <?php $first = false; ?>
            <?php endwhile; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
