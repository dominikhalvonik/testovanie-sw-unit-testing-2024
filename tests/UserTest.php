<?php

include_once "vendor/autoload.php";
include_once __DIR__ . "/../src/User.php";
include_once __DIR__ . "/../src/Address.php";

use PHPUnit\Framework\TestCase;
use App\User;
use App\Address;

class UserTest extends TestCase {

    public function testCanCreateUserWithoutAddress() {
        $name = "John Doe";
        $email = "john@doe.com";

        $user = new User($name, $email);

        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEmpty($user->getAddresses());
    }

    public function testCanCreateUserWithAddresses() {
        $address1 = new Address(Address::TYPE_PERMANENT, "Hlavná 1", "Bratislava", "81101", "Slovensko");
        $address2 = new Address(Address::TYPE_MAILING, "Poštová 5", "Bratislava", "81102", "Slovensko");

        $user = new User("John Doe", "john@doe.com", [$address1, $address2]);

        $this->assertCount(2, $user->getAddresses());
        $this->assertSame($address1, $user->getAddressByType(Address::TYPE_PERMANENT));
        $this->assertSame($address2, $user->getAddressByType(Address::TYPE_MAILING));
    }

    public function testAddAddress() {
        $user = new User("John Doe", "john@doe.com");
        $address = new Address(Address::TYPE_PERMANENT, "Hlavná 1", "Bratislava", "81101", "Slovensko");

        $user->addAddress($address);
        $this->assertCount(1, $user->getAddresses());
        $this->assertSame($address, $user->getAddressByType(Address::TYPE_PERMANENT));
    }

    public function testCannotAddDuplicateAddressType() {
        $this->expectException(\RuntimeException::class);

        $user = new User("John Doe", "john@doe.com");
        $address1 = new Address(Address::TYPE_PERMANENT, "Hlavná 1", "Bratislava", "81101", "Slovensko");
        $address2 = new Address(Address::TYPE_PERMANENT, "Iná 2", "Bratislava", "81102", "Slovensko");

        $user->addAddress($address1);
        $user->addAddress($address2); // Malo by vyhodiť výnimku
    }

    public function testRemoveAddressByType() {
        $address = new Address(Address::TYPE_PERMANENT, "Hlavná 1", "Bratislava", "81101", "Slovensko");
        $user = new User("John Doe", "john@doe.com", [$address]);

        $this->assertCount(1, $user->getAddresses());

        $user->removeAddressByType(Address::TYPE_PERMANENT);

        $this->assertCount(0, $user->getAddresses());
        $this->assertNull($user->getAddressByType(Address::TYPE_PERMANENT));
    }

    public function testGetAddressByTypeReturnsNullIfNotExist() {
        $user = new User("John Doe", "john@doe.com");
        $this->assertNull($user->getAddressByType(Address::TYPE_PERMANENT));
    }

    // Zachovanie pôvodných testov:
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
