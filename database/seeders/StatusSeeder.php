<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status')->insert([
            [
                "type" => "solicitado"
            ],
            [
                "type" => "Em produção"
            ],
            [
                "type" => "finalizado"
            ],
            [
                "type" => "Cancelado"
            ]
        ]);
    }
}
