<?php
// src/public/index.php
use Palmo\remember\RememberMeService;

require __DIR__ . "/vendor/autoload.php";
session_start();
if(isset($_COOKIE['rememberMe']) && !isset($_SESSION['userId'])){
    $rememberMeService = new RememberMeService();
    if($rememberMeService->validateToken($_COOKIE['rememberMe'])){
        $_SESSION['userId'] = $rememberMeService->getUserIdByToken($_COOKIE['rememberMe']);
    }
}
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

<nav>
    <ul>

        <?php
        if (isset($_SESSION['userId'])) {
            echo '<li><a href="./views/logout.php">Logout</a></li>';
            echo '<li><a href="./views/profile.php">Profile</a></li>';
            echo '<li><a href="./views/PreferencesController.php">Preferences</a></li>';
            echo '<li><a href="views/mydishes.php">My dishes</a></li>';
        } else {
            echo '<li><a href="./views/login.php">Login</a></li>';
            echo '<li><a href="./views/sign-up.php">Sign-up</a></li>';
        }
        echo '<li><a href="./views/faker.php">Faker</a></li>';
        ?>
    </ul>
</nav>

<div class="container">

</div>

</body>
</html>