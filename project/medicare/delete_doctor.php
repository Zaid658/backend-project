<?php
include 'config.php';

if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];

  
    $delete_doctor_query = "DELETE FROM doctors WHERE id = $doctor_id";
    $delete_result = mysqli_query($connection, $delete_doctor_query);

    if ($delete_result) {
        header("Location: index.php?msg=Doctor deleted successfully");
    } else {
        header("Location: index.php?error=Error deleting doctor");
    }
}
?>
