<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


if (isset($_POST['add_carousel'])) {
    $image = $_FILES['image']['name'];
    $caption = $_POST['caption'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $insert_carousel_query = "INSERT INTO carousel_items (image, caption) VALUES ('$target_file', '$caption')";
        mysqli_query($connection, $insert_carousel_query);
        header("Location: admin_carousel.php?msg=Carousel item added successfully.");
        exit();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$carousel_query = "SELECT * FROM carousel_items";
$carousel_result = mysqli_query($connection, $carousel_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Carousel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'adminnav.php' ?>
<div class="container mt-5">
    <h3>Manage Carousel</h3>
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Caption</label>
            <input type="text" name="caption" class="form-control" required>
        </div>
        <button type="submit" name="add_carousel" class="btn btn-primary mt-3">Add Carousel Item</button>
    </form>

    <h5 class="mt-5">Current Carousel Items</h5>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Image</th>
                <th>Caption</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($carousel = mysqli_fetch_assoc($carousel_result)): ?>
                <tr>
                    <td><img src="<?php echo $carousel['image']; ?>" alt="<?php echo $carousel['caption']; ?>" style="width: 150px; height: auto;"></td>
                    <td><?php echo $carousel['caption']; ?></td>
                    <td>
                        <a href="delete_carousel.php?id=<?php echo $carousel['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
