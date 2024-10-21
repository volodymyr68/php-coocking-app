<?php

namespace Palmo\validation;

class StringValidator implements ValidatorInterface {
    public function validate($data): bool {
        return is_string($data) && !empty($data);
    }
}