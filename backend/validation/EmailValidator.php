<?php

namespace Palmo\validation;

class EmailValidator implements ValidatorInterface {
    public function validate($data): bool {
        return filter_var($data, FILTER_VALIDATE_EMAIL) !== false;
    }
}