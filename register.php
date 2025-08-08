<?php
include "db.php";
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $hobbies    = isset($_POST['hobbies']) ? implode(",", $_POST['hobbies']) : "";
    $password   = $_POST['password'];
    $confirm    = $_POST['confirm_password'];
    $role       = 'user'; 

    $qry = "SELECT * FROM `users` WHERE email='$email'";
    $check_user = mysqli_query($conn, $qry) or die('Query failed: '.$qry);

    if (mysqli_num_rows($check_user) > 0) {
        $message[] = 'Email already exists!';
    } elseif ($password !== $confirm) {
        $message[] = 'Passwords do not match!';
    } else {
        $insert = "INSERT INTO `users` (first_name, last_name, email, phone, hobbies, password,cpassword, role) 
                   VALUES ('$first_name', '$last_name', '$email', '$phone', '$hobbies', '$password',  '$confirm','$role')";

        mysqli_query($conn, $insert) or die('Query failed: ' . mysqli_error($conn));

        $message[] = 'Registered successfully!';
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
            <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 w-50" role="alert">
                <span>' . $msg . '</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            ';
        }
    }
    ?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%;">
            <h2 class="text-center mb-4">Register</h2>
            <form action="" method="post">
                
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
    <div class="form-check form-check-inline">
        <input type="checkbox" class="form-check-input hobby-check" name="hobbies[]" value="Playing"> Playing
    </div>
    <div class="form-check form-check-inline">
        <input type="checkbox" class="form-check-input hobby-check" name="hobbies[]" value="Singing"> Singing
    </div>
    <div class="form-check form-check-inline">
        <input type="checkbox" class="form-check-input hobby-check" name="hobbies[]" value="Learning"> Learning
    </div>
    <div class="form-check form-check-inline">
        <input type="checkbox" class="form-check-input hobby-check" name="hobbies[]" value="Reading"> Reading
    </div>
    <div id="hobbyError" class="text-danger mt-1" style="display:none;">Please select at least one hobby.</div>
</div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">Register Now</button>
                <div class="text-center mt-3">
                    <a href="login.php">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.querySelector("form").addEventListener("submit", function(e) {
    let checked = document.querySelectorAll(".hobby-check:checked").length > 0;
    if (!checked) {
        e.preventDefault();
        document.getElementById("hobbyError").style.display = "block";
    } else {
        document.getElementById("hobbyError").style.display = "none";
    }
});
</script>

</body>
</html>
