<?php

namespace Palmo\remember;

abstract class RememberMe {
    abstract public function generateToken(): string;

    abstract public function saveToken(int $userId, string $token): void;

    abstract public function validateToken(string $token): bool;

    abstract public function removeToken(int $userId): void;
}