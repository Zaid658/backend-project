<?php
include 'config.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

   
    $delete_user_query = "DELETE FROM users WHERE user_id = $user_id";
    $delete_result = mysqli_query($connection, $delete_user_query);

    if ($delete_result) {
        header("Location: index.php?msg=User deleted successfully");
    } else {
        header("Location: index.php?error=Error deleting user");
    }
}
?>
