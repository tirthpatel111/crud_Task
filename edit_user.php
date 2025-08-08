<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $hobbies    = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : '';
    $password   = $_POST['password'];
    $role       = $_POST['role'];

    mysqli_query($conn, "UPDATE users 
        SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', hobbies='$hobbies', password='$password', role='$role' 
        WHERE id='$id'");

    header("Location: admin_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Edit User</h2>
        <form method="post">

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" value="<?= $user['first_name'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" value="<?= $user['last_name'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" value="<?= $user['phone'] ?>" class="form-control" maxlength="10" pattern="\d{10}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hobbies</label><br>
                <?php $user_hobbies = explode(", ", $user['hobbies']); ?>
                <?php 
                $all_hobbies = ['Playing', 'Singing', 'Learning', 'Reading'];
                foreach ($all_hobbies as $hobby) {
                    $checked = in_array($hobby, $user_hobbies) ? 'checked' : '';
                    echo "<div class='form-check'>
                            <input type='checkbox' class='form-check-input' name='hobbies[]' value='$hobby' $checked>
                            <label class='form-check-label'>$hobby</label>
                          </div>";
                }
                ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" name="password" value="<?= $user['password'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                </select>
            </div>

            <button class="btn btn-primary w-100">Update</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
