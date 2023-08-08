<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('optional')->insert([
            [
                "type" => "Bacon"
            ],
            [
                "type" => "Cheddar"
            ],
            [
                "type" => "Salame"
            ],
            [
                "type" => "Tomate"
            ],
            [
                "type" => "Cebola roxa"
            ],
            [
                "type" => "Pepino"
            ]
        ]);
    }
}
