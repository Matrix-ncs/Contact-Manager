<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO login_info (username, password) VALUES ('$username', '$password')";
    if ($conn->query($query)) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: Username might already exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign UP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <div class="container">
        <h2>Sign UP</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="signup-button">Sign UP</button>
        </form>
    </div>
</body>
</html>
