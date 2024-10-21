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

if (isset($_SESSION['userId']) && $_SESSION['userId']) {
    $updateResult = 'Nothing to update';
    if (isset($_POST['categories'])) {
        $categories = $_POST['categories'];
        if (count($categories) !== 0) {
            $dishRepository = new DishRepository();
            $dishRepository->saveSelectedCategories($_SESSION['userId'], $categories);
            $updateResult = 'Preferences saved successfully';
        }
    }
    if (isset($_POST['areas'])) {
        $areas = $_POST['areas'];
        if (count($areas) !== 0) {
            $dishRepository = new DishRepository();
            $dishRepository->saveSelectedAreas($_SESSION['userId'], $areas);
            $updateResult = 'Preferences saved successfully';
        }
    }


    $_SESSION['success'] = $updateResult;
    header("Location: ../views/profile.php");
    exit();
}
