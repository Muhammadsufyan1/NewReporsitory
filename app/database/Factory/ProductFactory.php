<?php

declare(strict_types=1);

namespace Database\Factory;

use Spiral\DatabaseSeeder\Factory\AbstractFactory;
use App\Entity\Product;
use Database\Factory\OrderFactory;

class ProductFactory extends AbstractFactory
{
    /**
     * Returns a fully qualified database entity class name
     */
    public function entity(): string
    {
        return Product::class;
    }
    public function definition(): array
    {
        return [
            'categoryId' => $this->faker->randomNumber(),
            'productName' => $this->faker->words(3, true)
        ];
    }
    public function makeEntity(array $definition): Product
    {
        return new Product(
            $definition['categoryId'],
            $definition['productName']
        );
    }
}
