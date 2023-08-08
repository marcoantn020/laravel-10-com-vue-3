<?php

namespace Database\Seeders;

use App\Models\Bread;
use App\Models\Burger;
use App\Models\Meat;
use App\Models\Optional;
use App\Models\Status;
use Exception;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        $faker = Factory::create('pt_BR');
        $bread = Bread::all()->pluck('type')->toArray();
        $meat = Meat::all()->pluck('type')->toArray();
        $optional = Optional::all()->pluck('type')->toArray();
        $status = Status::all()->pluck('id')->toArray();


        for ($i = 0; $i < 150; $i++) {
            $randomNumber = random_int(1, 2);
            if($randomNumber === 2) {
                DB::table('orders')->insert([
                    "name_client" => $faker->name(),
                    "bread" => $faker->randomElement($bread),
                    "meat" => $faker->randomElement($meat),
                    "burger_id" => 2,
                    "status_id" => $faker->randomElement($status),
                    "options" => json_encode([
                        $faker->randomElement($optional),
                        $faker->randomElement($optional),
                        $faker->randomElement($optional)
                    ])
                ]);
            } else {
                DB::table('orders')->insert([
                    "name_client" => $faker->name(),
                    "bread" => $faker->randomElement($bread),
                    "meat" => $faker->randomElement($meat),
                    "burger_id" => 1,
                    "status_id" => $faker->randomElement($status),
                    "options" => json_encode([])
                ]);
            }
        }
    }
}
