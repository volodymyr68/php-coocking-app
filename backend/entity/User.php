<?php

namespace Palmo\entity;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    function isCorrectUser(): bool
    {
        if ($this->name === '' && $this->password === '') {
            return false;
        }
        return true;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

}