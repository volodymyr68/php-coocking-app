<?php

namespace Palmo\remember;

use Palmo\repository\TokenRepository;

trait TokenStorage {
    public function saveToken(int $userId, string $token): void {
        $tokenRepository = new TokenRepository();
        $tokenRepository->saveToken($userId, $token);
    }

    public function validateTokenStorage(string $token): bool {
        $tokenRepository = new TokenRepository();
        return $tokenRepository->validateToken($token);
    }

    public function getUserIdByTokenStorage(string $token): bool {
        $tokenRepository = new TokenRepository();
        return $tokenRepository->getUserIdByToken($token);
    }

    public function removeToken(int $userId): void {
        echo "Token removed for user $userId.\n";
    }
}