<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['delete_id'])) {
    $service_id = (int)$_GET['delete_id']; // Typecast to int for security
    $delete_query = "DELETE FROM services WHERE id = ?";
    $stmt = $connection->prepare($delete_query);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    header("Location: add_service.php?msg=Service deleted successfully.");
    exit();
}

if (isset($_POST['add_service'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $insert_service_query = "INSERT INTO services (name, description, image) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($insert_service_query);
            $stmt->bind_param("sss", $name, $description, $target_file);
            $stmt->execute();
            header("Location: add_service.php?msg=Service added successfully.");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$services_query = "SELECT * FROM services";
$services_result = mysqli_query($connection, $services_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'adminnav.php'; ?>
    <div class="container mt-5">
        <h3>Add New Service</h3>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Service Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <button type="submit" name="add_service" class="btn btn-primary mt-3">Add Service</button>
        </form>

        <h3 class="mt-5">Existing Services</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($service = mysqli_fetch_assoc($services_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($service['id']); ?></td>
                    <td><?php echo htmlspecialchars($service['name']); ?></td>
                    <td><?php echo htmlspecialchars($service['description']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($service['image']); ?>" alt="Service Image" width="100"></td>
                    <td>
                        <a href="?delete_id=<?php echo htmlspecialchars($service['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
