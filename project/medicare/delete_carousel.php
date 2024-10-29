<?php
session_start();
include 'config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_query = "DELETE FROM carousel_items WHERE id = $id";
    mysqli_query($connection, $delete_query);
    header("Location: admin_carousel.php?msg=Carousel item deleted successfully.");
    exit();
}
