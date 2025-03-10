<?php

include_once "vendor/autoload.php";
include_once __DIR__ . "/../src/Address.php";

use PHPUnit\Framework\TestCase;
use App\Address;

class AddressTest extends TestCase {

    public function testCanCreateAddress() {
        $address = new Address(
            Address::TYPE_PERMANENT,
            "Hlavná 1",
            "Bratislava",
            "81101",
            "Slovensko"
        );

        $this->assertEquals(Address::TYPE_PERMANENT, $address->getType());
        $this->assertEquals("Hlavná 1", $address->getStreet());
        $this->assertEquals("Bratislava", $address->getCity());
        $this->assertEquals("81101", $address->getZipCode());
        $this->assertEquals("Slovensko", $address->getCountry());
    }

    public function testInvalidTypeThrowsException() {
        $this->expectException(\InvalidArgumentException::class);

        new Address(
            "invalid_type",
            "Hlavná 1",
            "Bratislava",
            "81101",
            "Slovensko"
        );
    }

    public function testEmptyStreetThrowsException() {
        $this->expectException(\InvalidArgumentException::class);

        new Address(
            Address::TYPE_PERMANENT,
            "",
            "Bratislava",
            "81101",
            "Slovensko"
        );
    }

    public function testEmptyCityThrowsException() {
        $this->expectException(\InvalidArgumentException::class);

        new Address(
            Address::TYPE_PERMANENT,
            "Hlavná 1",
            "",
            "81101",
            "Slovensko"
        );
    }

    public function testEmptyZipCodeThrowsException() {
        $this->expectException(\InvalidArgumentException::class);

        new Address(
            Address::TYPE_PERMANENT,
            "Hlavná 1",
            "Bratislava",
            "",
            "Slovensko"
        );
    }

    public function testEmptyCountryThrowsException() {
        $this->expectException(\InvalidArgumentException::class);

        new Address(
            Address::TYPE_PERMANENT,
            "Hlavná 1",
            "Bratislava",
            "81101",
            ""
        );
    }
}
