<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BurgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('burgers')->insert([
            [
                'name' => 'Tradicional',
                'price' => 20.45,
                'price_optional' => 0.00,
            ],
            [
                'name' => 'Artesanal',
                'price' => 30.00,
                'price_optional' => 3.00
            ],
        ]);
    }
}
