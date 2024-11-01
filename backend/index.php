<?php
// src/public/index.php
use Palmo\remember\RememberMeService;

require __DIR__ . "/vendor/autoload.php";
session_start();
$rememberMeService = new RememberMeService();
if (!isset($_SESSION['CSRFToken'])) {
    $_SESSION['CSRFToken'] = $rememberMeService->generateToken();
}
if (isset($_COOKIE['rememberMe']) && !isset($_SESSION['userId'])) {
    if ($rememberMeService->validateToken($_COOKIE['rememberMe'])) {
        $_SESSION['userId'] = $rememberMeService->getUserIdByToken($_COOKIE['rememberMe']);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
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
    <p>Here you can discover and save your favorite dishes! Sign up or login to get started.</p>

    <section class="features">
        <h2>Explore the World of Culinary Delights</h2>
        <p>Discover a wide range of recipes from different cuisines, personalized to your taste.</p>
        <ul>
            <li>Save and manage your favorite dishes</li>
            <li>Share your culinary creations with the community</li>
            <li>Set your dietary preferences and discover matching recipes</li>
        </ul>
    </section>

    <section class="call-to-action">
        <h2>Join Our Community</h2>
        <p>Become part of our growing community of food lovers! Sign up to start sharing and discovering amazing dishes.</p>
    </section>
</div>

<footer>
    <div class="footer-content">
        <div class="social-media">
            <a href="https://facebook.com" target="_blank">Facebook</a> |
            <a href="https://instagram.com" target="_blank">Instagram</a> |
            <a href="https://twitter.com" target="_blank">Twitter</a>
        </div>
    </div>
</footer>

</body>
</html>