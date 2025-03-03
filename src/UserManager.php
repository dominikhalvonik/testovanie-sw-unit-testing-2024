<?php

namespace App;

class UserManager {
    private array $users = [];

    public function addUser(User $user): void {
        foreach ($this->users as $existingUser) {
            if ($existingUser->getEmail() === $user->getEmail()) {
                throw new \RuntimeException("User with this email already exists.");
            }
        }
        $this->users[] = $user;
    }

    public function getUserByEmail(string $email): ?User {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
        return null;
    }

    public function getAllUsers(): array {
        return $this->users;
    }
}