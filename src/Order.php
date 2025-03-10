<?php

namespace App;

class Order {
    private array $items = [];

    public function addItem(OrderItem $item): void {
        $this->items[] = $item;
    }

    /**
     * @return OrderItem[]
     */
    public function getItems(): array {
        return $this->items;
    }

    public function getTotalPrice(): float {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->getTotalPrice();
        }
        return $total;
    }
}
