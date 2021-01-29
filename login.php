<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

</head>

<body>
    <div class="container">
        <form action="process_login.php" method="post">
            <div>
                <p>Username</p>
                <input type="text" name="username" placeholder="Enter your username">
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter your password">
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
        </form>
        <div>
            No Account? <a href="register.php">Create one</a>
        </div>
    </div>
</body>

</html>