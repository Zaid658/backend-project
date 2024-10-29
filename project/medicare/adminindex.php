<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    echo "<script>alert('You must be logged in as an admin to view this page.'); window.location.href='login.php';</script>";
    exit();
}

$sql_doctors = "SELECT * FROM users WHERE role_id = 2";  
$result_doctors = mysqli_query($connection, $sql_doctors);

$sql_patients = "SELECT * FROM users WHERE role_id = 3";  
$result_patients = mysqli_query($connection, $sql_patients);

$sql_pending_doctors = "SELECT * FROM users WHERE role_id = 2 AND status = 'pending'";
$result_pending_doctors = mysqli_query($connection, $sql_pending_doctors);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'adminnav.php' ?>
    <!-- Main Content -->
    <div class="container flex-grow-1">
        <h1>Welcome, Admin <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>

        <h2>Manage Doctors</h2>
        <?php
        if (mysqli_num_rows($result_doctors) > 0) {
            while ($row = mysqli_fetch_assoc($result_doctors)) {
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<p><strong>Doctor Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                echo "<p><strong>Status:</strong> " . ucfirst(htmlspecialchars($row['status'])) . "</p>";
                echo "</div></div>";
            }
        } else {
            echo "<p>No doctors found.</p>";
        }
        ?>

        <h2>Manage Patients</h2>
        <?php
        if (mysqli_num_rows($result_patients) > 0) {
            while ($row = mysqli_fetch_assoc($result_patients)) {
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<p><strong>Patient Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                echo "<p><strong>Status:</strong> " . ucfirst(htmlspecialchars($row['status'])) . "</p>";
                echo "</div></div>";
            }
        } else {
            echo "<p>No patients found.</p>";
        }
        ?>

        <h2>Pending Doctor Approvals</h2>
        <?php
        if (mysqli_num_rows($result_pending_doctors) > 0) {
            while ($row = mysqli_fetch_assoc($result_pending_doctors)) {
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<p><strong>Doctor Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                echo "
                <form method='post' action='admin_action.php'>
                    <input type='hidden' name='doctor_id' value='" . htmlspecialchars($row['user_id']) . "'>
                    <button type='submit' name='action' value='approve' class='btn btn-success'>Approve</button>
                    <button type='submit' name='action' value='reject' class='btn btn-danger'>Reject</button>
                </form>";
                echo "</div></div>";
            }
        } else {
            echo "<p>No pending doctor approvals.</p>";
        }
        ?>

        <h2>Manage Appointments</h2>
        <?php
        $sql_appointments = "SELECT * FROM appointments";
        $result_appointments = mysqli_query($connection, $sql_appointments);

        if (mysqli_num_rows($result_appointments) > 0) {
            while ($row = mysqli_fetch_assoc($result_appointments)) {
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<p><strong>Appointment ID:</strong> " . htmlspecialchars($row['id']) . "</p>";
                echo "<p><strong>Patient Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
                echo "<p><strong>Doctor ID:</strong> " . htmlspecialchars($row['doctor_id']) . "</p>";
                echo "<p><strong>Date:</strong> " . htmlspecialchars($row['appoint_date']) . "</p>";
                echo "<p><strong>Time:</strong> " . htmlspecialchars($row['appoint_time']) . "</p>";
                echo "<p><strong>Status:</strong> " . ucfirst(htmlspecialchars($row['status'])) . "</p>";
                echo "</div></div>";
            }
        } else {
            echo "<p>No appointments found.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>

<?php
mysqli_close($connection);
?>
