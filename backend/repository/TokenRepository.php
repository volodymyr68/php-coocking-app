<?php

namespace Palmo\repository;

use Palmo\db\Db;

class TokenRepository
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = (new Db())->getHandler();
    }
    public function saveToken(int $userId,string $token): void
    {
        $query = 'INSERT INTO user_tokens (user_id, token,expiry) VALUES (:user_id, :token, :expiry)';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
        $expiry = date('Y-m-d H:i:s', strtotime('+24 hour'));
        $stmt->bindParam(':expiry', $expiry, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function validateToken(string $token): bool {
        $query = 'SELECT * FROM user_tokens WHERE token = :token AND expiry > NOW()';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    public function getUserIdByToken(string $token): int {
        $query = 'SELECT * FROM user_tokens WHERE token = :token AND expiry > NOW()';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}