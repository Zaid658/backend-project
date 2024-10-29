<?php
include 'config.php';

if (isset($_POST['delete_btn'])) {
    $delete_id = $_POST['delete_id'];

    $query = "DELETE FROM users WHERE user_id='$delete_id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        header('Location: index.php');
    } else {
        header('Location: index.php');
    }
}
?>
