<?php

include_once "vendor/autoload.php";
include_once __DIR__ . "/../src/User.php";

use PHPUnit\Framework\TestCase;
use App\User;


class UserTest extends TestCase {

    public function testCanCreateUser() {
        $name = "John Doe";
        $email = "john@doe.com";

        $user = new User($name, $email);

        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
    }

    public function testSetName() {
        $user = new User("John Doe", "john@example.com");
        $user->setName("Jane Doe");
        $this->assertEquals("Jane Doe", $user->getName());
    }

    public function testSetEmail() {
        $user = new User("John Doe", "john@example.com");
        $user->setEmail("jane@example.com");
        $this->assertEquals("jane@example.com", $user->getEmail());
    }

    public function testEmptyNameThrowsException() {
        $this->expectException(\InvalidArgumentException::class);
        new User("", "john@example.com");
    }

    public function testInvalidEmailThrowsException() {
        $this->expectException(\InvalidArgumentException::class);
        new User("John Doe", "invalid-email");
    }
}