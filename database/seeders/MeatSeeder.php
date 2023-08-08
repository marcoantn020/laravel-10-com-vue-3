<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('meat')->insert([
            [
                "type" => "Maminha"
            ],
            [
                "type" => "Alcatra"
            ],
            [
                "type" => "Picanha"
            ],
            [
                "type" => "Veggie burger"
            ]
        ]);
    }
}
