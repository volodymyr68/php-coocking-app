<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <link rel="stylesheet" href='../css/signup.css'>
</head>
<body>
<form method="post" action="../controller/run.php">
    <?php
    echo '<label for="name">Enter name</label>';
    if (isset($_SESSION['name'])) {
        echo '<input type="text" id="name" name="name" value="' . $_SESSION['name'] . '">';
        unset($_SESSION['name']);
    } else {
        echo '<input type="text" id="username" name="name">';
    }
    echo '<label for="email">Enter email</label>';
    if (isset($_SESSION['email'])) {
        echo '<input type="email" id="email" name="email" value="' . $_SESSION['email'] . '">';
        unset($_SESSION['email']);
    } else {
        echo '<input type="email" id="email" name="email">';
    }
    echo '<input type="hidden" name="signup" value="true">';
    ?>
    <label for="password">Enter password</label>
    <input type="password" id="password" name="password">
    <?php
    if (isset($_SESSION['errors'])) {
        echo '<p style="color: red;">' . $_SESSION['errors'] . '</p>';
        unset($_SESSION['errors']);
    }
    ?>
    <input type="hidden" name="CSRFToken" value="<?php echo $_SESSION['CSRFToken'] ?>">
    <input type="submit" value="Login">
</form>
</body>
</html>
