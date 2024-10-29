<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to view this page.'); window.location.href='login.php';</script>";
    exit();
}


$doctorId = $_SESSION['user_id'];


include 'config.php'; 


$sql = "SELECT * FROM appointments WHERE doctor_id = '$doctorId' AND status = 'pending'";
$result = mysqli_query($connection, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Appointments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', sans-serif;
        }
        .container {
            margin-top: 40px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 12px 12px 0 0;
            padding: 20px;
            font-size: 1.25rem;
        }
        .card-body {
            padding: 30px;
        }
        .btn {
            padding: 12px 25px;
            font-size: 1rem;
            border-radius: 50px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card-text {
            margin-bottom: 15px;
        }
        .no-appointments {
            text-align: center;
            font-size: 1.25rem;
            margin-top: 20px;
            color: #6c757d; 
        }
        .sidebar {
            background-color: #343a40;
            height: 100vh;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
<div class="d-flex">

    <nav class="sidebar flex-shrink-0">
        <h4 class="text-white">Medicio</h4>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>

  
    <div class="container flex-grow-1">
        <h1 class="mb-4 text-center">Pending Appointments</h1>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Appointment ID: <?php echo htmlspecialchars($row['id']); ?></h5>
                    <p class="card-text"><strong>Patient Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                    <p class="card-text"><strong>Appointment Date:</strong> <?php echo htmlspecialchars($row['appoint_date']); ?></p>
                    <p class="card-text"><strong>Appointment Time:</strong> <?php echo htmlspecialchars($row['appoint_time']); ?></p>

                    <form action="approve_reject.php" method="post" class="d-inline-block">
                        <input type="hidden" name="appointment_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                        <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                    </form>
                </div>
            </div>
        <?php
            }
        } else {
            echo "<p class='no-appointments'>No pending appointments.</p>";
        }
        ?>
    </div>
</div>
<a href="logout.php" class="btn btn-danger">Logout</a>
<?php

mysqli_close($connection);
?>

</body>
</html>
