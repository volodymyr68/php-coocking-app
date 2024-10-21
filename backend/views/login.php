<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
</head>
<body>
<form method="post" action="../controller/auth.php">
    <?php
    echo '<label for="email">Enter email</label>';
    if (isset($_SESSION['email'])) {
        echo '<input type="email" id="email" name="email" value="' . $_SESSION['email'] . '">';
        unset($_SESSION['email']);
    } else {
        echo '<input type="email" id="email" name="email">';
    }
    echo '<input type="hidden" name="login" value="true">';
    ?>
    <label for="password">Enter password</label>
    <input type="password" id="password" name="password">
    <?php
    if (isset($_SESSION['errors'])) {
        echo '<p style="color: red;">' . $_SESSION['errors'] . '</p>';
        unset($_SESSION['errors']);
    }
    ?>
    <label for="rememberMe">Remember me</label>
    <input type="checkbox" id="rememberMe" name="rememberMe" >
    <input type="hidden" name="login" value="true">
    <input type="submit" value="Login">
</form>

</body>
</html>