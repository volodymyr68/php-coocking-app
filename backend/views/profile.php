<?php
require "../vendor/autoload.php";

use Palmo\repository\DishRepository;
use Palmo\repository\UserRepository;

session_start();
if (!isset($_SESSION['userId'])) {
    session_unset();
    session_destroy();
    header("Location:../views/login.php");
    exit();
}
$userID = $_SESSION['userId'];
$userRepository = new UserRepository();
$dishRepository = new DishRepository();
$user = $userRepository->findById($userID);
$allCategories = $dishRepository->getCategories();
$allAreas = $dishRepository->getAreas();
$selectedCategories = $dishRepository->getSelectedCategories($userID);
$selectedAreas = $dishRepository->getSelectedAreas($userID);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <link rel="stylesheet" href='../css/profile.css'>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../views/preferences.php">Preferences</a></li>
            <li><a href="../views/mydishes.php">My dishes</a></li>
            <li><a href="../views/random.php">Random dishes</a></li>
            <li><a href="../views/forum.php">Forum</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main>
    <?php
    echo '<h1>Hello ' . $user->getName() . ' </h1>';
    ?>
    <form method="post" action="../controller/PreferencesController.php">
        <div>
            <?php
            echo '<label for="category">Select a category:</label>';
            if (count($selectedCategories) === 0) {
                echo '<select id="category" name="categories[]" multiple>';
                foreach ($allCategories as $category) {
                    echo '<option value="' . $category['category'] . '">' . $category['category'] . '</option>';
                }
                echo '</select>';
            } else {
                $selectedCategoriesArray = explode(",", $selectedCategories[0]['categories']);
                echo '<select id="category" name="categories[]" multiple>';
                foreach ($allCategories as $category) {
                    if (in_array($category['category'], $selectedCategoriesArray)) {
                        echo '<option value="' . $category['category'] . '" selected>' . $category['category'] . '</option>';
                    } else {
                        echo '<option value="' . $category['category'] . '">' . $category['category'] . '</option>';
                    }
                }
                echo '</select>';
            }
            echo '<label for="category">Select a category:</label>';
            if (count($selectedAreas) === 0) {
                echo '<select id="area" name="areas[]" multiple>';
                foreach ($allAreas as $area) {
                    echo '<option value="' . $area['area'] . '">' . $area['area'] . '</option>';
                }
                echo '</select>';
            } else {
                $selectedAreasArray = explode(",", $selectedAreas[0]['areas']);
                echo '<select id="area" name="areas[]" multiple>';
                foreach ($allAreas as $area) {
                    if (in_array($area['area'], $selectedAreasArray)) {
                        echo '<option value="' . $area['area'] . '" selected>' . $area['area'] . '</option>';
                    } else {
                        echo '<option value="' . $area['area'] . '">' . $area['area'] . '</option>';
                    }
                }
                echo '</select>';
            }
            ?>
        </div>
        <input type="submit" value="Save">
    </form>
    <?php
    if (isset($_SESSION['success'])) {
        echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
        unset($_SESSION['success']);
    }
    ?>
</main>
</body>
</html>