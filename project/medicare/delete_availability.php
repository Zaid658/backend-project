<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


if (isset($_GET['id'])) {
    $availability_id = $_GET['id'];

   
    if (!filter_var($availability_id, FILTER_VALIDATE_INT)) {
        die("Invalid availability ID.");
    }

    $delete_availability_query = "DELETE FROM availability WHERE id = $availability_id";
    if (!mysqli_query($connection, $delete_availability_query)) {
        die("Error deleting availability: " . mysqli_error($connection));
    }

    header("Location: doctor_availability.php?msg=Availability deleted successfully.");
    exit();
}
?>
