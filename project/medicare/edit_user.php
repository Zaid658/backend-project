<?php
include 'config.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

   
    $user_query = "SELECT * FROM users WHERE user_id = $user_id";
    $user_result = mysqli_query($connection, $user_query);
    $user = mysqli_fetch_assoc($user_result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];

  
    $update_query = "UPDATE users SET name = '$name', email = '$email', city = '$city' WHERE user_id = $user_id";
    mysqli_query($connection, $update_query);

    header("Location: index.php?msg=User updated successfully");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <div class="container">
        <h3>Edit User</h3>
        <form method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" value="<?php echo $user['city']; ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</body>
</html>
