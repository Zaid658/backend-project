<?php
session_start();
include 'config.php';

// Check if the user is logged in as admin
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: login.php");
    exit();
}

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role_id = $_POST['role_id'];
    $city = $_POST['city'];

    // Insert new user into the users table
    $insert_user_query = "INSERT INTO users (name, email, password, role_id, city) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($connection, $insert_user_query)) {
        mysqli_stmt_bind_param($stmt, "sssis", $name, $email, $password, $role_id, $city);
        if (mysqli_stmt_execute($stmt)) {
            $user_id = mysqli_insert_id($connection); // Get the ID of the inserted user
            
            // If role is doctor, insert into doctors table
            if ($role_id == 2) { // Assuming role_id 2 is for doctors
                $specialization = $_POST['specialization']; // Fetch specialization from form
                $insert_doctor_query = "INSERT INTO doctors (id, name, specialization, email, password, status) VALUES (?, ?, ?, ?, ?, 'approved')";
                if ($stmt_doctor = mysqli_prepare($connection, $insert_doctor_query)) {
                    mysqli_stmt_bind_param($stmt_doctor, "issss", $user_id, $name, $specialization, $email, $password);
                    mysqli_stmt_execute($stmt_doctor);
                } else {
                    echo "Error preparing doctor insert: " . mysqli_error($connection);
                }
            }
            
            
            if ($role_id == 3) { 
                $age = $_POST['age'];
                $phone = $_POST['phone'];
                $insert_patient_query = "INSERT INTO patients (user_id, age, phone) VALUES (?, ?, ?)";
                if ($stmt_patient = mysqli_prepare($connection, $insert_patient_query)) {
                    mysqli_stmt_bind_param($stmt_patient, "iis", $user_id, $age, $phone);
                    mysqli_stmt_execute($stmt_patient);
                } else {
                    echo "Error preparing patient insert: " . mysqli_error($connection);
                }
            }

            echo "User added successfully!";
        } else {
            echo "Error inserting user: " . mysqli_error($connection);
        }
    } else {
        echo "Error preparing statement: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php include 'adminnav.php'; ?>
<div class="container py-5">
    <h3>Add New User</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select class="form-control" name="role_id" required>
                <option value="2">Doctor</option>
                <option value="3">Patient</option>
            </select>
        </div>
        <div class="form-group">
            <label>City</label>
            <input type="text" class="form-control" name="city" required>
        </div>
        <div class="form-group" id="doctor-fields" style="display:none;">
            <label>Specialization</label>
            <input type="text" class="form-control" name="specialization" required>
        </div>
        <div class="form-group" id="patient-fields" style="display:none;">
            <label>Age</label>
            <input type="number" class="form-control" name="age" required>
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>

<script>
    const roleSelect = document.querySelector('select[name="role_id"]');
    const doctorFields = document.getElementById('doctor-fields');
    const patientFields = document.getElementById('patient-fields');

    roleSelect.addEventListener('change', function() {
        if (this.value == '2') { // Doctor selected
            doctorFields.style.display = 'block';
            patientFields.style.display = 'none';
        } else { // Patient selected
            doctorFields.style.display = 'none';
            patientFields.style.display = 'block';
        }
    });
</script>

</body>
</html>
