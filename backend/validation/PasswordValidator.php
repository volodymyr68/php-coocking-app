<?php

namespace Palmo\validation;

class PasswordValidator implements ValidatorInterface
{
    public function validate($data): bool
    {
        return strlen($data) >= 5;
    }
}