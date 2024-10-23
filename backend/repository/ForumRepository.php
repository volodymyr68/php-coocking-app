<?php

namespace Palmo\repository;

use Palmo\db\Db;

class ForumRepository
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = (new Db())->getHandler();
    }
    public function getMessages(): array{
        $query = 'SELECT * FROM Comment';
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addMessage(string $message, int $userId): void {
        $query = 'INSERT INTO Comment (text, user_id, time) VALUES (:text, :user_id, :time)';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':text', $message, \PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);

        $time = date('Y-m-d H:i:s', time());
        $stmt->bindParam(':time', $time, \PDO::PARAM_STR);

        $stmt->execute();
    }
}