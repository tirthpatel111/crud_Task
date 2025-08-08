<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
$id = $_SESSION['id'];
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Profile of User - <?php echo $user['first_name'] . " " . $user['last_name']; ?></h2>
    <table class="table table-bordered table-striped">
        <tr><th>ID</th><td><?php echo $user['id']; ?></td></tr>
        <tr><th>First Name</th><td><?php echo $user['first_name']; ?></td></tr>
        <tr><th>Last Name</th><td><?php echo $user['last_name']; ?></td></tr>
        <tr><th>Email</th><td><?php echo $user['email']; ?></td></tr>
        <tr><th>Phone</th><td><?php echo $user['phone']; ?></td></tr>
        <tr><th>Hobbies</th><td><?php echo $user['hobbies']; ?></td></tr>
        <tr><th>Password</th><td><?php echo $user['password']; ?></td></tr>
        <tr><th>Role</th><td><?php echo $user['role']; ?></td></tr>
    </table>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

</body>
</html>
