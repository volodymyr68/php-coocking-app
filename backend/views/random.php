<?php

use Palmo\repository\DishRepository;

require "../vendor/autoload.php";

session_start();
if (!isset($_SESSION['userId'])) {
    session_unset();
    session_destroy();
    header("Location:../views/login.php");
    exit();
}

$dishes = [];
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 6;
$offset = ($currentPage - 1) * $limit;
$dishRepository = new DishRepository();
$dishes = $dishRepository->getRandomDishes();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dishes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href='../css/random.css'>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../views/profile.php">Profile</a></li>
            <li><a href="../views/mydishes.php">My dishes</a></li>
            <li><a href="../views/random.php">Random dishes</a></li>
            <li><a href="../views/preferences.php">Preferences</a></li>
            <li><a href="../views/forum.php">Forum</a></li>
            <li><a href="../views/logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="container">
        <?php if (!empty($dishes)): ?>
            <?php foreach ($dishes as $dish): ?>
                <div class="card">
                    <img src="<?= $dish['img'] ?>" alt="<?= $dish['name'] ?>">
                    <h3><?= htmlspecialchars($dish['name']) ?></h3>
                    <p><?= htmlspecialchars($dish['description']) ?></p>
                    <div class="info">Area: <?= htmlspecialchars($dish['area']) ?> |
                        Category: <?= htmlspecialchars($dish['category']) ?></div>
                    <div class="buttons">
                        <form method="post" action="../controller/run.php">
                            <input type="hidden" name="dish_id" value="<?= $dish['id'] ?>">
                            <input type="hidden" name="method" value="save-random">
                            <button type="submit">Save</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No dishes found.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>