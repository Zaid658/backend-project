<?php
include 'config.php';


$services_query = "SELECT * FROM services";
$services_result = mysqli_query($connection, $services_query);
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
}
.card {
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%; 
    border-radius: 15px;
    overflow: hidden; 
}
.card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}
.card-img-top {
    height: 200px; 
    object-fit: cover; 
}
.card-title {
    font-size: 1.25rem; 
    font-weight: bold; 
}
.card-text {
    font-size: 1rem;
    color: #6c757d;
}
.container {
    padding: 20px;
}

    </style>
</head>
<body>

<div class="container mt-5">
 
    <div class="row">
        <?php while ($service = mysqli_fetch_assoc($services_result)): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="<?php echo $service['image']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($service['name']); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($service['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($service['description']); ?></p>
                        
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
