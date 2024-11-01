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

$dishes = $dishRepository->getUserDishes($_SESSION['userId'], $offset, $limit);
$totalDishes = $dishRepository->getUserDishesCount($_SESSION['userId']);
$totalPages = ceil($totalDishes / $limit);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dishes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href='../css/mydishes.css'>
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
                            <input type="hidden" name="method" value="delete">
                            <input type="hidden" name="CSRFToken" value="<?php echo $_SESSION['CSRFToken'] ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No dishes found.</p>
        <?php endif; ?>
    </div>

    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>">« Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" <?= $i === $currentPage ? 'style="font-weight: bold;"' : '' ?>><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>">Next »</a>
        <?php endif; ?>
    </div>
</main>
</body>
</html>