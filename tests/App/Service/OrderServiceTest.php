<?php

namespace Tests\App\Service;

use App\Models\Burger;
use App\Models\Sales;
use App\Models\Status;
use App\Service\OrderService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_must_be_create_a_order(): void
    {
        $status = Status::create(['type' => 'solicitado']);
        Burger::create(['name' => 'Tradicional', 'price' => '12.45']);
        $burgerHandmade = Burger::create(['name' => 'Artesanal', 'price' => '20.00', 'price_optional' => 3.00]);


        $order_data = [
            "name_client" => "Marco",
            "bread" => "Parmesão e Orégano",
            "meat" => "Alcatra",
            "burger_id" => $burgerHandmade->id,
            "status_id" => $status->id,
            "options" => ["Bacon", "Cheddar", "Salame"]
        ];

        $order = new OrderService();
        $response = $order->create($order_data);

        $this->assertIsInt($response);

        $price = null;
        if($burgerHandmade->name === "Artesanal") {
            $price =  ($burgerHandmade->price_optional * count($order_data['options'])) + $burgerHandmade->price;

            $sale = Sales::create([
                "price" => $price,
                "order_id" => $response
            ]);
        } else {
            $sale = Sales::create([
                "price" => $burgerHandmade->price,
                "order_id" => $response
            ]);
        }
        $sale = Sales::where('order_id', $response)->first();
        $this->assertEquals($price, $sale->price);

    }

    public function test_burger_not_found(): void
    {
        try {
            // arrange
            $order_data = [
                "name_client" => "Marco",
                "bread" => "Parmesão e Orégano",
                "meat" => "Alcatra",
                "burger_id" => null,
                "status_id" => 1,
                "options" => []
            ];
            // act
            $order = new OrderService();
            $order->create($order_data);
        } catch (Exception $exception) {
            // assert
            $this->assertEquals(404, $exception->getCode());
            $this->assertEquals("Burger not found", $exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function test_must_be_update_status(): void
    {
        $statusRequested = Status::create(['type' => 'solicitado']);
        $statusInProduction = Status::create(['type' => 'em producao']);
        Status::create(['type' => 'finalizado']);

        Burger::create(['name' => 'Tradicional', 'price' => '12.45']);
        $burgerHandmade = Burger::create(['name' => 'handmade', 'price' => '20.45', 'price_optional', '3.00']);

        $order_data = [
            "name_client" => "Marco",
            "bread" => "Parmesão e Orégano",
            "meat" => "Alcatra",
            "burger_id" => $burgerHandmade->id,
            "status_id" => $statusRequested->id,
            "options" => ["Bacon", "Cheddar", "Salame"]
        ];

        $orderService = new OrderService();
        $order = $orderService->create($order_data);

        $result = $orderService->update($order, $statusInProduction->id);
        $this->assertNotNull($result);
    }

    public function test_must_be_return_error_404_if_not_find_order(): void
    {
        try {
            $orderNotExist = 12;
            $status_id = 2;

            $orderService = new OrderService();
            $orderService->update($orderNotExist, $status_id);
        } catch(Exception $exception) {
            $this->assertEquals(404, $exception->getCode());
            $this->assertEquals("Order not found", $exception->getMessage());
        }
    }
}
