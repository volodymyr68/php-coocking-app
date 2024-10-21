<?php

namespace Palmo\remember;

class RememberMeService extends RememberMe {
    use TokenStorage, JustTrait {
        TokenStorage::saveToken as storageSaveToken;
        TokenStorage::removeToken insteadof JustTrait;
        JustTrait::removeToken as removeTokenFromJustTrait;
    }
    public function generateToken(): string {
        return bin2hex(random_bytes(32));
    }

    public function saveToken(int $userId, string $token): void {
        $this->storageSaveToken($userId, $token);
    }

    public function validateToken(string $token): bool {
        return $this->validateTokenStorage($token);
    }

    public function getUserIdByToken(string $token): int {
        return $this->getUserIdByTokenStorage($token);
    }

    public function removeToken(int $userId): void {
        $this->removeToken($userId); //TokenStorage
//        $this->removeTokenFromJustTrait(); //JustTrait
    }
}