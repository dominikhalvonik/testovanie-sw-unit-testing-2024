<?php

namespace App;

class User {
    private string $name;
    private string $email;
    /** @var Address[] */
    private array $addresses = []; // pole adries

    private array $orders = []; // nové

    public function __construct(string $name, string $email, array $addresses = []) {
        $this->setName($name);
        $this->setEmail($email);
        foreach ($addresses as $address) {
            $this->addAddress($address);
        }
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

    /**
     * @return Address[]
     */
    public function getAddresses(): array {
        return $this->addresses;
    }

    public function addAddress(Address $address): void {
        // Overíme, či už adresa daného typu existuje (možno nechceš duplicity pre typ)
        foreach ($this->addresses as $existingAddress) {
            if ($existingAddress->getType() === $address->getType()) {
                throw new \RuntimeException("Address of type '{$address->getType()}' already exists.");
            }
        }
        $this->addresses[] = $address;
    }

    public function removeAddressByType(string $type): void {
        foreach ($this->addresses as $key => $address) {
            if ($address->getType() === $type) {
                unset($this->addresses[$key]);
                $this->addresses = array_values($this->addresses); // Preindexujeme pole
                return;
            }
        }
    }

    public function getAddressByType(string $type): ?Address {
        foreach ($this->addresses as $address) {
            if ($address->getType() === $type) {
                return $address;
            }
        }
        return null;
    }

    public function addOrder(Order $order): void {
        $this->orders[] = $order;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array {
        return $this->orders;
    }
}
