<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];


if (isset($_POST['add_availability'])) {
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    if (!filter_var($doctor_id, FILTER_VALIDATE_INT)) {
        die("Invalid doctor ID.");
    }

    $insert_availability_query = "INSERT INTO availability (doctor_id, day, start_time, end_time) 
                                   VALUES ('$doctor_id', '$day', '$start_time', '$end_time')";
    
    if (!mysqli_query($connection, $insert_availability_query)) {
        die("Error inserting availability: " . mysqli_error($connection));
    }

    header("Location: doctor_availability.php?msg=Availability added successfully.");
    exit();
}


$availability_query = "SELECT * FROM availability WHERE doctor_id = $doctor_id";
$availability_result = mysqli_query($connection, $availability_query);
if (!$availability_result) {
    die("Error fetching availability: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Availability</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Your Availability</h3>
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Select Day</label>
            <select name="day" class="form-control" required>
                <option value="">-- Select Day --</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
        </div>
        <div class="form-group">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>
        <button type="submit" name="add_availability" class="btn btn-primary mt-3">Add Availability</button>
    </form>

    <h5 class="mt-5">Current Availability</h5>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($availability = mysqli_fetch_assoc($availability_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($availability['day']); ?></td>
                    <td><?php echo htmlspecialchars($availability['start_time']); ?></td>
                    <td><?php echo htmlspecialchars($availability['end_time']); ?></td>
                    <td>
                        <a href="delete_availability.php?id=<?php echo $availability['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
