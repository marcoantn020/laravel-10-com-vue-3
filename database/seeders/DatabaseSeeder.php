<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BreadsSeeder::class,
            BurgerSeeder::class,
            MeatSeeder::class,
            OptionalSeeder::class,
            StatusSeeder::class,
            OrderSeeder::class,
            SalesSeeder::class
        ]);
    }
}
