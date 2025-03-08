<?php

declare(strict_types=1);

namespace Database\Factory;

use Spiral\DatabaseSeeder\Factory\AbstractFactory;
use App\Entity\Store;

class StoreFactory extends AbstractFactory
{
    /**
     * Returns a fully qualified database entity class name
     */
    public function entity(): string
    {
        return Store::class;
    }

    /**
     * Returns array with generation rules
     */
    public function definition(): array
    {
        return [
            'regionId' => $this->faker->randomNumber(),
            'storeName' => $this->faker->words(3, true),
        ];
    }
    public function makeEntity(array $definition): Store
    {
        return new Store(
            $definition['regionId'],
            $definition['storeName']
        );
    }
}
