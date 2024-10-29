<?php
include 'config.php';  
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in first.'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id']; 


$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);


if (!$user) {
    echo "<script>alert('User not found.'); window.location.href='login.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Your Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group text-center">
                            <img src="<?php echo $user['profile_pic']; ?>" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <p id="name"><?php echo $user['name']; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <p id="email"><?php echo $user['email']; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <p id="city"><?php echo $user['city']; ?></p>
                        </div>
                        <div class="form-group">
                            <a href="update_profile.php" class="btn btn-primary btn-block">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
