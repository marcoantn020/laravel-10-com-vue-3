<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('breads')->insert([
            [
                "type" => "Italiano Branco"
            ],
            [
                "type" => "3 Queijos"
            ],
            [
                "type" => "Parmesão e Orégano"
            ],
            [
                "type" => "Integral"
            ],
        ]);
    }
}
