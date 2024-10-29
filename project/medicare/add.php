<?php
include 'config.php';

if (isset($_POST['add_user_btn'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $city = mysqli_real_escape_string($connection, $_POST['city']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "INSERT INTO users (name, city, email, password) VALUES ('$name', '$city', '$email', '$password')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        // Redirect to index after successful addition
        header('Location: index.php');
    } else {
        // Redirect to index if there's an error
        header('Location: index.php');
    }
}
?>
