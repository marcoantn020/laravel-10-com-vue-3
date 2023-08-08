<?php

namespace Database\Seeders;

use App\Models\Order;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('pt_BR');
        $order = Order::all()->pluck('id')->toArray();
        $orderBurger = Order::with('burger')->get();

        for ($i = 0; $i < 150; $i++) {
            DB::table('sales')->insert([
                "order_id" => $faker->randomElement($order),
                "price" => $orderBurger[$i]->burger->price,
            ]);
        }
    }
}
