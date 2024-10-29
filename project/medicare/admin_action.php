<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    echo "<script>alert('Unauthorized access.'); window.location.href='login.php';</script>";
    exit();
}

if (isset($_POST['doctor_id']) && isset($_POST['action'])) {
    $doctorId = mysqli_real_escape_string($connection, $_POST['doctor_id']);
    $action = mysqli_real_escape_string($connection, $_POST['action']);

   
    $newStatus = ($action == 'approve') ? 'approved' : 'rejected';

    $sql = "UPDATE users SET status = '$newStatus' WHERE user_id = '$doctorId' AND role_id = 2";
    
    if (mysqli_query($connection, $sql)) {
        $message = ($action == 'approve') ? 'Doctor approved successfully.' : 'Doctor rejected successfully.';
        echo "<script>alert('$message'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating status: " . mysqli_error($connection) . "'); window.location.href='adminindex.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='admin_dashboard.php';</script>";
}

mysqli_close($connection);
?>
