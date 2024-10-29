<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', sans-serif;
        }
        .container {
            margin-top: 40px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-body {
            padding: 30px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 50px;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        h2 {
            margin-top: 40px;
            margin-bottom: 20px;
        }
        .sidebar {
            background-color: #343a40;
            height: 100vh;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
<body>
<div class="d-flex">

    <nav class="sidebar flex-shrink-0">
        <h4 class="text-white">Admin Dashboard</h4>
        <a href="index.php">Manage Doctors and users</a>
        <a href="profile.php">view or edit profile</a>
        <a href="adminindex.php">Manage Approvals</a>
        <a href="add_service.php">Add Services</a>
        <a href="admin_carousel.php">Add carousel</a>
        <!-- <a href="add_user.php">Add user</a> -->
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </nav>
</body>
</html>