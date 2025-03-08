<?php

declare(strict_types=1);

namespace Database\Seeder;

use Spiral\DatabaseSeeder\Seeder\AbstractSeeder;
use Spiral\DatabaseSeeder\Attribute\Seeder;
use Database\Factory\ProductFactory;

#[Seeder]
class ProductTableSeeder extends AbstractSeeder
{
    /**
     * Returns iterable database entities
     */
    public function run(): \Generator
    {
        yield ProductFactory::new()->createOne();
    }
}
