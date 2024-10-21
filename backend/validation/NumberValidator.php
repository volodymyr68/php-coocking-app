<?php

namespace Palmo\validation;

class NumberValidator implements ValidatorInterface {
    public function validate($data): bool {
        return is_numeric($data);
    }
}