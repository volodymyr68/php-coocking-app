<?php

namespace Palmo\service;

use JetBrains\PhpStorm\NoReturn;
use Palmo\repository\DishRepository;

class PreferenceService
{
    #[NoReturn] public function save(): void
    {
        $updateResult = 'Nothing to update';
        $dishRepository = new DishRepository();
        if (isset($_POST['categories'])) {
            $categories = $_POST['categories'];
            if (count($categories) !== 0) {

                $dishRepository->saveSelectedCategories($_SESSION['userId'], $categories);
                $updateResult = 'Preferences saved successfully';
            }
        }
        if (isset($_POST['areas'])) {
            $areas = $_POST['areas'];
            if (count($areas) !== 0) {
                $dishRepository->saveSelectedAreas($_SESSION['userId'], $areas);
                $updateResult = 'Preferences saved successfully';
            }
        }
        $_SESSION['success'] = $updateResult;
        header("Location: ../views/profile.php");
        exit();
    }
}