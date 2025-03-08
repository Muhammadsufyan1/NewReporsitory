<?php

declare(strict_types=1);

namespace Database\Seeder;
use Database\Factory\OrderFactory;

use Spiral\DatabaseSeeder\Seeder\AbstractSeeder;
use Spiral\DatabaseSeeder\Attribute\Seeder;

#[Seeder]
class OrderTableSeeder extends AbstractSeeder
{
    /**
     * Returns iterable database entities
     */
    public function run(): \Generator
    {
        yield OrderFactory::new()->createOne();
    }
}
