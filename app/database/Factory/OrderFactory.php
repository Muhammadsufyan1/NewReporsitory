<?php

declare(strict_types=1);

namespace Database\Factory;

use Spiral\DatabaseSeeder\Factory\AbstractFactory;
use App\Entity\Order;
use Database\Factory\StoreFactory;
use Database\Factory\ProductFactory;

class OrderFactory extends AbstractFactory
{
    /**
     * Returns a fully qualified database entity class name
     */
    public function entity(): string
    {
        return Order::class;
    }

    /**
     * Returns array with generation rules
     */
    public function definition(): array
    {
        $store = StoreFactory::new()->createOne();
        $product = ProductFactory::new()->createOne();

        return [
            'customerId' => $this->faker->randomNumber(),
            'product' => $product,
            'productId' => $product->getProductId(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'unitPrice' => $this->faker->randomFloat(2, 10, 100),
            'orderDate' => $this->faker->dateTimeThisYear(),
            'store' => $store,
            'storeId' => $store->getStoreId()
        ];
    }
    public function makeEntity(array $definition): Order
    {
        return new Order(
            $definition['customerId'],
            $definition['product'],
            $definition['productId'],
            $definition['quantity'],
            $definition['unitPrice'],
            $definition['orderDate'],
            $definition['store'],
            $definition['storeId']
        );
    }
}
