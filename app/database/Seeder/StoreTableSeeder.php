<?php

declare(strict_types=1);

namespace Database\Seeder;

use Spiral\DatabaseSeeder\Seeder\AbstractSeeder;
use Spiral\DatabaseSeeder\Attribute\Seeder;
use Database\Factory\StoreFactory;

#[Seeder]
class StoreTableSeeder extends AbstractSeeder
{
    /**
     * Returns iterable database entities
     */
    public function run(): \Generator
    {
        yield StoreFactory::new()->createOne();
    }
}
