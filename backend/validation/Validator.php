<?php

namespace Palmo\validation;

class Validator {
    protected $type;
    protected $data;
    protected $validator;

    public function __construct($type, $data) {
        $this->type = $type;
        $this->data = $data;
        $this->setValidator();
    }

    protected function setValidator() {
        switch ($this->type) {
            case 'string':
                $this->validator = new StringValidator();
                break;
            case 'number':
                $this->validator = new NumberValidator();
                break;
            case 'email':
                $this->validator = new EmailValidator();
                break;
            case 'password':
                $this->validator = new PasswordValidator();
                break;
            default:
                throw new Exception("Невідомий тип даних для валідації.");
        }
    }

    public function validate(): bool {
        return $this->validator->validate($this->data);
    }
}