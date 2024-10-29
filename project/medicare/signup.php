
<?php
include 'config.php';  

if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $role = $_POST['role'];  
    
    $specialization = null;
    if ($role == 2) {
        $specialization = mysqli_real_escape_string($connection, $_POST['specialization']);
    }
    
    $status = ($role == 2) ? 'pending' : 'approved';  
 
 $profile_pic = null; 
 if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
     $target_dir = "uploads/";
     $profile_pic = $target_dir . basename($_FILES['profile_pic']['name']);
     $uploadOk = 1;
     
     $check = getimagesize($_FILES['profile_pic']['tmp_name']);
     if ($check === false) {
         echo "<script>alert('File is not an image.');</script>";
         $uploadOk = 0;
     }
     
   
     $imageFileType = strtolower(pathinfo($profile_pic, PATHINFO_EXTENSION));
     if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
         echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
         $uploadOk = 0;
     }


     if ($uploadOk && !move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profile_pic)) {
         echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
         $profile_pic = null; 
     }
 }


 $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (name, email, password, role_id, status) VALUES ('$name', '$email', '$password', '$role', '$status')";
    
    if (mysqli_query($connection, $sql)) {
        $user_id = mysqli_insert_id($connection);  
        
        if ($role == 2) {
            $doctor_sql = "INSERT INTO doctors (id,name,email ,specialization) VALUES ('$user_id','$name','$email', '$specialization')";
            mysqli_query($connection, $doctor_sql);
            echo "<script>alert('Signup successful! Wait for admin approval.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Signup successful!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Signup failed: " . mysqli_error($connection) . "');</script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Create an Account</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required>
                                <div class="invalid-feedback">
                                    Please enter your name.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                                <div class="invalid-feedback">
                                    Please enter your password.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control" id="role" onchange="showSpecialization(this)" required>
                                    <option value="" disabled selected>Select your role</option>
                                    <option value="2">Doctor</option>
                                    <option value="3">Patient</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a role.
                                </div>
                            </div>

                           
                            <div class="form-group" id="specializationField" style="display:none;">
                                <label for="specialization">Specialization</label>
                                <select name="specialization" class="form-control" id="specialization">
                                    <option value="" disabled selected>Select specialization</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Neurology">Neurology</option>
                                    <option value="Orthopedics">Orthopedics</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    
                                </select>
                                <div class="invalid-feedback">
                                    Please select a specialization.
                                </div>
                            </div>
                            <div class="form-group">
    <label for="profile_pic">Profile Picture</label>
    <input type="file" name="profile_pic" class="form-control" id="profile_pic" required>
    <div class="invalid-feedback">
        Please upload your profile picture.
    </div>
</div>
                            <button type="submit" name="signup" class="btn btn-primary btn-block">Signup</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="login.php" class="text-primary">Already have an account? Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
   
        function showSpecialization(select) {
            var specializationField = document.getElementById('specializationField');
            if (select.value == 2) {
                specializationField.style.display = 'block';
            } else {
                specializationField.style.display = 'none';
            }
        }

       
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>