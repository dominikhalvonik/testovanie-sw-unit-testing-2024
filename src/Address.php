<?php

namespace App;

class Address {
    public const TYPE_PERMANENT = 'permanent'; // Trvalý pobyt
    public const TYPE_MAILING = 'mailing';    // Korešpondenčná adresa
    public const TYPE_RENTAL = 'rental';      // Nájom

    private string $type;
    private string $street;
    private string $city;
    private string $zipCode;
    private string $country;

    public function __construct(string $type, string $street, string $city, string $zipCode, string $country) {
        $this->setType($type);
        $this->setStreet($street);
        $this->setCity($city);
        $this->setZipCode($zipCode);
        $this->setCountry($country);
    }

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): void {
        $allowedTypes = [self::TYPE_PERMANENT, self::TYPE_MAILING, self::TYPE_RENTAL];
        if (!in_array($type, $allowedTypes, true)) {
            throw new \InvalidArgumentException("Invalid address type.");
        }
        $this->type = $type;
    }

    // Ostatné gettery a settery rovnaké ako predtým

    public function getStreet(): string {
        return $this->street;
    }

    public function setStreet(string $street): void {
        if (empty($street)) {
            throw new \InvalidArgumentException("Street cannot be empty.");
        }
        $this->street = $street;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function setCity(string $city): void {
        if (empty($city)) {
            throw new \InvalidArgumentException("City cannot be empty.");
        }
        $this->city = $city;
    }

    public function getZipCode(): string {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): void {
        if (empty($zipCode)) {
            throw new \InvalidArgumentException("Zip code cannot be empty.");
        }
        $this->zipCode = $zipCode;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function setCountry(string $country): void {
        if (empty($country)) {
            throw new \InvalidArgumentException("Country cannot be empty.");
        }
        $this->country = $country;
    }
}
