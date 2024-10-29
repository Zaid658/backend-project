<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit(); 
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email =  $_POST['email']; 
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $appoint_date = $_POST['appoint_date'];
    $appoint_time = $_POST['appoint_time'];
    $message = $_POST['message'];
    $specialization = $_POST['specialization'];
    $userId = $_SESSION['user_id'];

    $doctor_query = "SELECT * FROM doctors WHERE specialization = '$specialization' AND status = 'approved' LIMIT 1";
    $doctor_result = mysqli_query($connection, $doctor_query);
    
    if (mysqli_num_rows($doctor_result) > 0) {
        $doctor = mysqli_fetch_assoc($doctor_result);
        $doctor_id = $doctor['id'];

        $sql = "INSERT INTO appointments (name, email, phone, age, appoint_date, appoint_time, message, doctor_id, user_id, status) 
                VALUES ('$name', '$email', '$phone', '$age', '$appoint_date', '$appoint_time', '$message', '$doctor_id', '$userId', 'pending')";

        if (mysqli_query($connection, $sql)) {
            echo "<script>alert('Appointment successfully booked and is pending approval!'); window.location.href ='appointment.php';</script>";
        } else {
            echo "<script>alert('Failed to book appointment: " . mysqli_error($connection) . "');</script>";
        }
    } else {
        echo "<script>alert('No available doctor with this specialization. Please try again later.');</script>";
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

<?php include 'nav.php' ?>
<!-- Main Content -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title text-center text-primary">Book an Appointment</h4>
                    <form action="" method="post" class="mt-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="name" 
                                       value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>" 
                                       class="form-control" placeholder="Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" 
                                       value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" 
                                       class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-md-6">
                                <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="age" class="form-control" placeholder="Age" required>
                            </div>
                            <div class="col-md-6">
                                <input type="date" name="appoint_date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <input type="time" name="appoint_time" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <select name="specialization" class="form-select" required>
                                    <option value="" disabled selected>Select Specialization</option>
                                    <?php
                                    $specialization_query = "SELECT DISTINCT specialization FROM doctors WHERE status = 'approved'";
                                    $specialization_result = mysqli_query($connection, $specialization_query);

                                    while ($row = mysqli_fetch_assoc($specialization_result)) {
                                        echo "<option value='" . $row['specialization'] . "'>" . $row['specialization'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="message" cols="30" rows="4" placeholder="Write Comments"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="submit" class="btn btn-primary w-100">SUBMIT NOW</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-3 mt-5">
    <div class="container">
        <p class="mb-0">© 2024 Medicio. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
