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
            $allCategories = $dishRepository->getCategories();
            $allCategoryNames = array_map(function($item) {
                return $item['category'];
            }, $allCategories);
            foreach ($categories as $category) {
                if(!in_array($category,$allCategoryNames)){
                    $_SESSION['error'] = 'Category not found';
                    header('Location: ../views/profile.php');
                    exit();
                }
            }
            if (count($categories) !== 0) {
                $dishRepository->saveSelectedCategories($_SESSION['userId'], $categories);
                $updateResult = 'Preferences saved successfully';
            }
        }
        if (isset($_POST['areas'])) {
            $areas = $_POST['areas'];
            $allAreas = $dishRepository->getAreas();
            $allAreaNames = array_map(function($item) {
                return $item['area'];
            }, $allAreas);
            foreach ($areas as $area) {
                if (!in_array($area, $allAreaNames)) {
                    $_SESSION['error'] = 'Area not found';
                    header('Location: ../views/profile.php');
                    exit();
                }
            }
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