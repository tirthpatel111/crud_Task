<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>Admin Dashboard</h2>
<a href="add_user.php" class="btn btn-primary mb-3">Add User</a>
<a href="logout.php" class="btn btn-danger mb-3">Logout</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Hobbies</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php while($user = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['first_name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td><?= $user['password'] ?></td>
            <td><?= $user['hobbies'] ?></td>
            <td><?= $user['role'] ?></td>
            <td>
                <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?');">Delete</a>
            </td>
        </tr>
        
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
