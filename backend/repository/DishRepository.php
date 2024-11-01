<?php

namespace Palmo\repository;

use Palmo\db\Db;
use PDO;

class DishRepository
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = (new Db())->getHandler();
    }
    public function getDishes(): array
    {

        $query = 'SELECT * FROM dishes';
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAreas(): array
    {
        $query = 'SELECT DISTINCT(area) FROM dishes';
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCategories(): array
    {
        $query = 'SELECT DISTINCT(category) FROM dishes';
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSelectedCategories(int $userId): array
    {
        $query = 'SELECT * FROM selected_categories WHERE userID = :user_id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSelectedAreas(int $userId): array
    {
        $query = 'SELECT * FROM selected_areas WHERE userID = :user_id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function saveSelectedCategories(int $userId, array $categories): void{
        $query = 'DELETE FROM selected_categories WHERE userID = :user_id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $query = 'INSERT INTO selected_categories (userID, categories) VALUES (:user_id, :categories)';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $categories = implode(",",$categories);
        $stmt->bindParam(':categories', $categories, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function saveSelectedAreas(int $userId, array $areas): void{
        $query = 'DELETE FROM selected_areas WHERE userID = :user_id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $query = 'INSERT INTO selected_areas (userID, areas) VALUES (:user_id, :areas)';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $areas = implode(",",$areas);
        $stmt->bindParam(':areas', $areas, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getFilteredDishes(int $userId, int $offset, int $limit): array
    {
        $categories = $this->getSelectedCategories($userId);
        $areas = $this->getSelectedAreas($userId);

        $categoriesArray = explode(',', $categories[0]['categories']);
        $areasArray = explode(',', $areas[0]['areas']);

        if (empty($categoriesArray) || empty($areasArray)) {
            return [];
        }
        $placeholdersCategories = implode(',', array_fill(0, count($categoriesArray), '?'));
        $placeholdersAreas = implode(',', array_fill(0, count($areasArray), '?'));
        $query = "SELECT * FROM dishes WHERE category IN ($placeholdersCategories) AND area IN ($placeholdersAreas) LIMIT ?, ?";
        $stmt = $this->dbh->prepare($query);
        $params = array_merge($categoriesArray, $areasArray);
        $params[] = $offset;
        $params[] = $limit;
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDishesCount(int $userId): int {
        $categories = $this->getSelectedCategories($userId);
        $areas = $this->getSelectedAreas($userId);
        if (empty($categories[0]['categories']) || empty($areas[0]['areas'])) {
            return 0;
        }
        $categoriesArray = explode(',', $categories[0]['categories']);
        $areasArray = explode(',', $areas[0]['areas']);
        $placeholdersCategories = implode(',', array_fill(0, count($categoriesArray), '?'));
        $placeholdersAreas = implode(',', array_fill(0, count($areasArray), '?'));
        $query = "SELECT COUNT(*) FROM dishes WHERE category IN ($placeholdersCategories) AND area IN ($placeholdersAreas)";
        $stmt = $this->dbh->prepare($query);
        $params = array_merge($categoriesArray, $areasArray);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function saveDish(int $userID,int $dishID): void{
        $query = 'INSERT INTO user_dishes (user_id,dish_id) VALUES (:user_id, :dish_id)';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id',$userID);
        $stmt->bindParam(':dish_id',$dishID);
        $stmt->execute();
    }

    public function checkUserDish(int $userID, int $dishID): bool
    {
        $query = 'SELECT COUNT(*) FROM user_dishes WHERE user_id = :user_id AND dish_id = :dish_id';
        $stmt = $this->dbh->prepare($query);
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
        $query = 'SELECT dishes.* FROM dishes JOIN user_dishes ON dishes.id = user_dishes.dish_id WHERE user_dishes.user_id = :user_id LIMIT :offset, :limit';
        $stmt = $this->dbh->prepare($query);

        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserDishesCount(int $userID): int
    {
        $query = 'SELECT COUNT(*) FROM dishes JOIN user_dishes ON dishes.id = user_dishes.dish_id WHERE user_dishes.user_id = :user_id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function deleteDish(int $userID,int $dishID): void{
        $query = 'DELETE FROM user_dishes WHERE user_id = :user_id AND dish_id = :dish_id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id',$userID);
        $stmt->bindParam(':dish_id',$dishID);
        $stmt->execute();
    }

    public function getRandomDishes(): array{
        $query = 'SELECT * FROM dishes ORDER BY RAND() LIMIT 6';
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchByName(string $name, int $userId, int $offset, int $limit): array {
        $categories = $this->getSelectedCategories($userId);
        $areas = $this->getSelectedAreas($userId);

        $categoriesArray = explode(',', $categories[0]['categories']);
        $areasArray = explode(',', $areas[0]['areas']);

        if (empty($categoriesArray) || empty($areasArray)) {
            return [];
        }

        $placeholdersCategories = implode(',', array_fill(0, count($categoriesArray), '?'));
        $placeholdersAreas = implode(',', array_fill(0, count($areasArray), '?'));

        $query = "SELECT * FROM dishes 
              WHERE category IN ($placeholdersCategories) 
              AND area IN ($placeholdersAreas) 
              AND name LIKE ? 
              LIMIT ?, ?";

        $stmt = $this->dbh->prepare($query);

        $params = array_merge($categoriesArray, $areasArray);
        $params[] = '%' . $name . '%';
        $params[] = $offset;
        $params[] = $limit;

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchByNameCount(int $userId, string $name): int {
        $categories = $this->getSelectedCategories($userId);
        $areas = $this->getSelectedAreas($userId);

        if (empty($categories[0]['categories']) || empty($areas[0]['areas'])) {
            return 0;
        }

        $categoriesArray = explode(',', $categories[0]['categories']);
        $areasArray = explode(',', $areas[0]['areas']);

        $placeholdersCategories = implode(',', array_fill(0, count($categoriesArray), '?'));
        $placeholdersAreas = implode(',', array_fill(0, count($areasArray), '?'));

        $query = "SELECT COUNT(*) FROM dishes 
              WHERE category IN ($placeholdersCategories) 
              AND area IN ($placeholdersAreas) 
              AND name LIKE ?";

        $stmt = $this->dbh->prepare($query);

        $params = array_merge($categoriesArray, $areasArray);
        $params[] = '%' . $name . '%';

        $stmt->execute($params);

        return $stmt->fetchColumn();
    }
}


