<?php
include 'config.php';

if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];

  
    $doctor_query = "SELECT * FROM doctors WHERE id = $doctor_id";
    $doctor_result = mysqli_query($connection, $doctor_query);
    $doctor = mysqli_fetch_assoc($doctor_result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];

    
    $update_query = "UPDATE doctors SET name = '$name', email = '$email', specialization = '$specialization' WHERE id = $doctor_id";
    mysqli_query($connection, $update_query);

    header("Location: index.php?msg=Doctor updated successfully");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
</head>
<body>
    <div class="container">
        <h3>Edit Doctor</h3>
        <form method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $doctor['name']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $doctor['email']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Specialization</label>
                <input type="text" name="specialization" value="<?php echo $doctor['specialization']; ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</body>
</html>
