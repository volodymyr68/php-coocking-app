<?php

namespace Palmo\validation;

interface ValidatorInterface {
    public function validate($data): bool;
}