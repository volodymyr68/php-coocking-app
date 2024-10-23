<?php

namespace Palmo\repository;

use Exception;
use Palmo\db\Db;
use Palmo\entity\User;
use PDO;

class UserRepository
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = (new Db())->getHandler();
    }
    public function save(string $name,string $email, string $password ): void
    {
        $query = 'insert into User (name, email, password) VALUES (:name, :email, :password)';
        $stmt = $this->dbh->prepare($query);

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() === 0) {
            throw new Exception('User creation failed');
        }
    }
    public function findByEmail(string $email): User
    {
        $query = 'select * from User where email = :email';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return new User( (int)null,"", "", "");
        }
        return new User($result['id'], $result['name'], $result['email'], $result['password']);
    }
    public function findById(int $id): User
    {
        $query ='select * from User where id = :id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return new User( (int)null,"", "", "");
        }
        return new User($result['id'], $result['name'], $result['email'], $result['password']);
    }
}