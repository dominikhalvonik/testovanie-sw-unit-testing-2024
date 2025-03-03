<?php

namespace App;

class User {
    private string $name;
    private string $email;

    public function __construct(string $name, string $email) {
        $this->setName($name);
        $this->setEmail($email);
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        if (empty($name)) {
            throw new \InvalidArgumentException("Name cannot be empty.");
        }
        $this->name = $name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email format.");
        }
        $this->email = $email;
    }
}