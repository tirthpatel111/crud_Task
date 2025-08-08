<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $hobbies    = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : '';
    $password   = $_POST['password'];
    $role       = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users (first_name, last_name, email, phone, hobbies, password, role) 
                         VALUES ('$first_name', '$last_name', '$email', '$phone', '$hobbies', '$password', '$role')");

    header("Location: admin_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User or Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Add User / Admin</h2>
        <form method="post">

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" maxlength="10" pattern="\d{10}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hobbies</label><br>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="hobbies[]" value="Playing"> Playing
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="hobbies[]" value="Singing"> Singing
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="hobbies[]" value="Learning"> Learning
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="hobbies[]" value="Reading"> Reading
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button class="btn btn-primary w-100">Save</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
