<?php

namespace Palmo\repository;

use Palmo\db\Db;
use PDO;

class DishRepository
{
    public function getDishes(): array
    {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT * FROM Dish';
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAreas(): array
    {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT DISTINCT(area) FROM Dish';
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCategories(): array
    {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT DISTINCT(category) FROM Dish';
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSelectedCategories(int $userId): array
    {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT * FROM selected_categories WHERE userID = :user_id';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSelectedAreas(int $userId): array
    {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT * FROM selected_areas WHERE userID = :user_id';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function saveSelectedCategories(int $userId, array $categories): void{
        $dbh = (new Db())->getHandler();
        $query = 'DELETE FROM selected_categories WHERE userID = :user_id';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $query = 'INSERT INTO selected_categories (userID, categories) VALUES (:user_id, :categories)';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $categories = implode(",",$categories);
        $stmt->bindParam(':categories', $categories, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function saveSelectedAreas(int $userId, array $areas): void{
        $dbh = (new Db())->getHandler();
        $query = 'DELETE FROM selected_areas WHERE userID = :user_id';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $query = 'INSERT INTO selected_areas (userID, areas) VALUES (:user_id, :areas)';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $areas = implode(",",$areas);
        $stmt->bindParam(':areas', $areas, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getFilteredDishes(int $userId, int $offset, int $limit): array
    {
        $dbh = (new Db())->getHandler();

        $categories = $this->getSelectedCategories($userId);
        $areas = $this->getSelectedAreas($userId);

        $categoriesArray = explode(',', $categories[0]['categories']);
        $areasArray = explode(',', $areas[0]['areas']);

        if (empty($categoriesArray) || empty($areasArray)) {
            return [];
        }
        $placeholdersCategories = implode(',', array_fill(0, count($categoriesArray), '?'));
        $placeholdersAreas = implode(',', array_fill(0, count($areasArray), '?'));
        $query = "SELECT * FROM Dish WHERE category IN ($placeholdersCategories) AND area IN ($placeholdersAreas) LIMIT ?, ?";
        $stmt = $dbh->prepare($query);
        $params = array_merge($categoriesArray, $areasArray);
        $params[] = $offset;
        $params[] = $limit;
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDishesCount(int $userId): int {
        $dbh = (new Db())->getHandler();
        $categories = $this->getSelectedCategories($userId);
        $areas = $this->getSelectedAreas($userId);
        if (empty($categories[0]['categories']) || empty($areas[0]['areas'])) {
            return 0;
        }
        $categoriesArray = explode(',', $categories[0]['categories']);
        $areasArray = explode(',', $areas[0]['areas']);
        $placeholdersCategories = implode(',', array_fill(0, count($categoriesArray), '?'));
        $placeholdersAreas = implode(',', array_fill(0, count($areasArray), '?'));
        $query = "SELECT COUNT(*) FROM Dish WHERE category IN ($placeholdersCategories) AND area IN ($placeholdersAreas)";
        $stmt = $dbh->prepare($query);
        $params = array_merge($categoriesArray, $areasArray);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function saveDish(int $userID,int $dishID): void{
        $dbh = (new Db())->getHandler();
        $query = 'INSERT INTO User_dishes (user_id,dish_id) VALUES (:user_id, :dish_id)';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id',$userID);
        $stmt->bindParam(':dish_id',$dishID);
        $stmt->execute();
    }

    public function checkUserDish(int $userID, int $dishID): bool
    {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT COUNT(*) FROM User_dishes WHERE user_id = :user_id AND dish_id = :dish_id';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id',$userID);
        $stmt->bindParam(':dish_id',$dishID);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        if($result === 0){
            return false;
        }
        return true;
    }

    public function getUserDishes(int $userID, int $offset, int $limit): array
    {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT Dish.* FROM Dish JOIN User_dishes ON Dish.id = User_dishes.dish_id WHERE User_dishes.user_id = :user_id LIMIT :offset, :limit';
        $stmt = $dbh->prepare($query);

        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserDishesCount(int $userID): int
    {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT COUNT(*) FROM Dish JOIN User_dishes ON Dish.id = User_dishes.dish_id WHERE User_dishes.user_id = :user_id';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function deleteDish(int $userID,int $dishID): void{
        $dbh = (new Db())->getHandler();
        $query = 'DELETE FROM User_dishes WHERE user_id = :user_id AND dish_id = :dish_id';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id',$userID);
        $stmt->bindParam(':dish_id',$dishID);
        $stmt->execute();
    }

    public function getRandomDishes(): array{
        $dbh = (new Db())->getHandler();
        $query = 'SELECT * FROM Dish ORDER BY RAND() LIMIT 6';
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


