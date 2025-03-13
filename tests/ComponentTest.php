<?php

include_once "vendor/autoload.php";
include_once __DIR__ . "/../src/User.php";
include_once __DIR__ . "/../src/Address.php";
include_once __DIR__ . "/../src/Order.php";
include_once __DIR__ . "/../src/OrderItem.php";
include_once __DIR__ . "/../src/Product.php";

use PHPUnit\Framework\TestCase;
use App\User;
use App\Address;
use App\Order;
use App\OrderItem;
use App\Product;

class ComponentTest extends TestCase {

    public function testUserCanPlaceOrder() {
        $user = new User("Ján Novák", "jan@example.com");

        $address = new Address(Address::TYPE_PERMANENT, "Hlavná 1", "Bratislava", "81101", "Slovensko");
        $user->addAddress($address);

        $product1 = new Product("Notebook", 1000.00);
        $product2 = new Product("Myš", 25.00);

        $order = new Order();
        $order->addItem(new OrderItem($product1, 1));
        $order->addItem(new OrderItem($product2, 2));

        $user->addOrder($order);

        // Assertions
        $this->assertCount(1, $user->getOrders());
        $this->assertEquals(1050.00, $order->getTotalPrice());

        $this->assertCount(1, $user->getAddresses());
        $this->assertEquals("Bratislava", $user->getAddresses()[0]->getCity());
    }
}
