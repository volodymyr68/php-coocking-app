<?php

namespace Palmo\service;

use JetBrains\PhpStorm\NoReturn;
use Palmo\repository\DishRepository;
use Palmo\repository\UserRepository;
use Palmo\validation\Validator;

class DishService
{
    #[NoReturn] public function save(): void
    {
        if (isset($_POST['dish_id']) && $_POST['dish_id']) {
            $dishId = $_POST['dish_id'];
            $dishRepository = new DishRepository();
            if ($dishRepository->checkUserDish($_SESSION['userId'], $dishId) != 1) {
                $dishRepository->saveDish($_SESSION['userId'], $dishId);
                if ($_POST['method'] === 'save') {
                    header("Location:../views/preferences.php");
                } else {
                    header("Location:../views/random.php");
                }
                exit();
            }
            $_SESSION['errors'] = "This dish already exists in your preferences";
            $_SESSION['dish_id'] = $dishId;
            if ($_POST['method'] === 'save') {
                header("Location:../views/preferences.php");
            } else {
                header("Location:../views/random.php");
            }

            exit();
        }
    }

    #[NoReturn] public function delete(): void
    {
        if (isset($_POST['dish_id']) && $_POST['dish_id']) {
            $dishId = $_POST['dish_id'];
            $dishRepository = new DishRepository();
            $dishRepository->deleteDish($_SESSION['userId'], $dishId);
            header("Location:../views/mydishes.php");
            exit();
        }
    }

}