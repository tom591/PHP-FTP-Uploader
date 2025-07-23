<?php
session_start();

$auth_username = "your-admin-username";
$auth_password = "your-secret-password";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'] ?? '';
    $input_password = $_POST['password'] ?? '';

    if ($input_username === $auth_username && $input_password === $auth_password) {
        $_SESSION['logged_in'] = true;
        header("Location: upload.php");
        exit;
    } else {
        $error_message = "Incorrect username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="files/bootstrap.min.css">
<script src="files/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="files/style.css">
<title>Login</title>
</head>
<body>
<div class="center">
<h4>Login</h4>
<?php if (isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
<form method="POST" action="login.php">
<div class="form-floating mb-3 mt-3">
<input type="text" class="form-control" id="username" placeholder="Username" name="username">
<label for="username">Username</label>
</div>
<div class="form-floating mt-3 mb-3">
<input type="password" class="form-control" id="password" placeholder="Password" name="password">
<label for="password">Password</label>
</div>
<button type="submit" class="btn btn-primary">Login</button>
</form>
</div>
</body>
</html>
<?php?>