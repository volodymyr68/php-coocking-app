<?php

namespace Palmo\repository;

use Palmo\db\Db;

class TokenRepository
{
    public function saveToken(int $userId,string $token): void
    {
        $dbh = (new Db())->getHandler();
        $query = 'INSERT INTO user_tokens (user_id, token,expiry) VALUES (:user_id, :token, :expiry)';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
        $expiry = date('Y-m-d H:i:s', strtotime('+24 hour'));
        $stmt->bindParam(':expiry', $expiry, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function validateToken(string $token): bool {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT * FROM user_tokens WHERE token = :token AND expiry > NOW()';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    public function getUserIdByToken(string $token): int {
        $dbh = (new Db())->getHandler();
        $query = 'SELECT * FROM user_tokens WHERE token = :token AND expiry > NOW()';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result ;
    }
}