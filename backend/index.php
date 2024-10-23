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
    <link rel="stylesheet" href='../css/index.css'>
</head>
<body>

<nav>
    <ul>

        <?php
        if (isset($_SESSION['userId'])) {
            echo '<li><a href="./views/logout.php">Logout</a></li>';
            echo '<li><a href="./views/profile.php">Profile</a></li>';
            echo '<li><a href="./views/preferences.php">Preferences</a></li>';
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
    <h1>Welcome to the Dish Palace!</h1>
    <p>Here you can discover and save your favorite dishes!</p>
    <p>Sign up or login to get started.</p>
</div>

</body>
</html>