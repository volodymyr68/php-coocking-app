<?php

namespace Palmo\repository;

use Exception;
use Palmo\db\Db;
use Palmo\entity\User;
use PDO;

class UserRepository
{

    public function save(string $name,string $email, string $password ): void
    {
        $dbh = (new Db())->getHandler();
//        INSERT INTO User (name, email, password)
//        VALUES ('Vova', 'email@example.com', '12345');
        $query = 'insert into User (name, email, password) VALUES (:name, :email, :password)';
        $stmt = $dbh->prepare($query);

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
        $dbh = (new Db())->getHandler();
        $query = 'select * from User where email = :email';
        $stmt = $dbh->prepare($query);
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
        $dbh = (new Db())->getHandler();
        $query ='select * from User where id = :id';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return new User( (int)null,"", "", "");
        }
        return new User($result['id'], $result['name'], $result['email'], $result['password']);
    }
}