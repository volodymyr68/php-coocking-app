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

if (isset($_POST['method']) && ($_POST['method'] === 'save' || $_POST['method'] === 'save-random')) {
    if (isset($_POST['dish_id']) && $_POST['dish_id']) {
        $dishId = $_POST['dish_id'];
        $dishRepository = new DishRepository();
        if ($dishRepository->checkUserDish($_SESSION['userId'], $dishId) != 1) {
            $dishRepository->saveDish($_SESSION['userId'], $dishId);
            if ($_POST['method'] === 'save') {
                header("Location:../views/PreferencesController.php");
            } else {
                header("Location:../views/random.php");
            }
            exit();
        }
        $_SESSION['errors'] = "This dish already exists in your preferences";
        $_SESSION['dish_id'] = $dishId;
        if ($_POST['method'] === 'save') {
            header("Location:../views/PreferencesController.php");
        } else {
            header("Location:../views/random.php");
        }

        exit();
    }
}
if (isset($_POST['method']) && $_POST['method'] === 'delete') {
    if (isset($_POST['dish_id']) && $_POST['dish_id']) {
        $dishId = $_POST['dish_id'];
        $dishRepository = new DishRepository();
        $dishRepository->deleteDish($_SESSION['userId'], $dishId);
        header("Location:../views/mydishes.php");
        exit();
    }
}
