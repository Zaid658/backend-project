<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$users_query = "SELECT * FROM users WHERE role_id = 3"; // Fetch all patients
$doctors_query = "SELECT d.id, d.name, d.specialization, d.email 
                  FROM doctors d"; // Fetch all doctors

$users_result = mysqli_query($connection, $users_query);
$doctors_result = mysqli_query($connection, $doctors_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<?php include 'adminnav.php' ?>
<div class="container py-5">
    <h3>Manage Users (Patients)</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($users_result)): ?>
            <tr>
                <td><?php echo $user['user_id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['city']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="delete_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3 class="mt-5">Manage Doctors</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Doctor ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Specialization</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($doctor = mysqli_fetch_assoc($doctors_result)): ?>
            <tr>
                <td><?php echo $doctor['id']; ?></td>
                <td><?php echo $doctor['name']; ?></td>
                <td><?php echo $doctor['email']; ?></td>
                <td><?php echo $doctor['specialization']; ?></td>
                <td>
                    <a href="edit_doctor.php?id=<?php echo $doctor['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="delete_doctor.php?id=<?php echo $doctor['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this doctor?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
