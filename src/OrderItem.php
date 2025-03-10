<?php

namespace App;

class OrderItem {
    private Product $product;
    private int $quantity;

    public function __construct(Product $product, int $quantity) {
        if ($quantity <= 0) {
            throw new \InvalidArgumentException("Quantity must be greater than zero.");
        }
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function getTotalPrice(): float {
        return $this->product->getPrice() * $this->quantity;
    }
}
