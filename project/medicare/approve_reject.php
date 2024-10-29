<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to perform this action.'); window.location.href='login.php';</script>";
    exit();
}

include 'config.php';

if (isset($_POST['appointment_id']) && isset($_POST['action'])) {
    $appointmentId = mysqli_real_escape_string($connection, $_POST['appointment_id']);
    $action = mysqli_real_escape_string($connection, $_POST['action']);

    
    $newStatus = ($action === 'approve') ? 'approved' : 'rejected';

    $sql = "UPDATE appointments SET status = '$newStatus' WHERE id = '$appointmentId'";

    if (mysqli_query($connection, $sql)) {
    
        $message = ($action === 'approve') ? 'Appointment approved successfully!' : 'Appointment rejected successfully!';
        echo "<script>alert('$message'); window.location.href='appointments.php';</script>";
    } else {
        echo "<script>alert('Error updating appointment status: " . mysqli_error($connection) . "'); window.location.href='pending_appointments.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request. Please try again.'); window.location.href='appointments.php';</script>";
}


mysqli_close($connection);
?>
