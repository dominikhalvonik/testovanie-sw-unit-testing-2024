<?php

include_once "vendor/autoload.php";
include_once __DIR__ . "/../src/User.php";
include_once __DIR__ . "/../src/UserManager.php";

use PHPUnit\Framework\TestCase;
use App\User;
use App\UserManager;

class UserManagerTest extends TestCase {

    public function testCanAddUser() {
        $userManager = new UserManager();
        $user = new User("John Doe", "john@example.com");
        $userManager->addUser($user);

        $this->assertCount(1, $userManager->getAllUsers());
        $this->assertSame($user, $userManager->getUserByEmail("john@example.com"));
    }

    public function testCannotAddDuplicateEmail() {
        $this->expectException(\RuntimeException::class);

        $userManager = new UserManager();
        $user1 = new User("John Doe", "john@example.com");
        $user2 = new User("Jane Doe", "john@example.com");

        $userManager->addUser($user1);
        $userManager->addUser($user2); // Malo by vyvolať výnimku
    }

    public function testGetUserByEmailReturnsCorrectUser() {
        $userManager = new UserManager();
        $user1 = new User("John Doe", "john@example.com");
        $user2 = new User("Jane Doe", "jane@example.com");

        $userManager->addUser($user1);
        $userManager->addUser($user2);

        $this->assertSame($user2, $userManager->getUserByEmail("jane@example.com"));
    }

    public function testGetUserByEmailReturnsNullIfNotFound() {
        $userManager = new UserManager();
        $this->assertNull($userManager->getUserByEmail("nonexistent@example.com"));
    }

    public function testGetAllUsers() {
        $userManager = new UserManager();
        for($i = 0; $i < 10; $i++) {
            $user = new User("John Doe " . $i , "john".$i."@example.com");
            $userManager->addUser($user);
        }

        $this->assertCount(10, $userManager->getAllUsers());
    }
}