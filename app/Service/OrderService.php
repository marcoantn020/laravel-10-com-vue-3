<?php

namespace App\Service;

use App\Models\Burger;
use App\Models\Order;
use App\Models\Sales;
use App\Repositories\BaseRepository;
use App\Repositories\OrderRepository;
use Exception;

class OrderService
{

    private ?OrderRepository $orderRepository = null;
    private int $requested = 1;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository(new Order);
    }


    /**
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function create($data): mixed
    {
        $burger = (new BaseRepository(new Burger))->find($data['burger_id']);
        if (is_null($burger)) {
            throw new Exception("Burger not found", 404);
        }
        $data['status_id'] = $this->requested;
        $order = $this->orderRepository->create($data);
        $this->registerSale($burger, $order);
        return $order->id;
    }


    /**
     * @param $order_id
     * @param $status_id
     * @return mixed
     * @throws Exception
     */
    public function update($order_id, $status_id): mixed
    {
        $res = $this->orderRepository->update($order_id, [
            "status_id" => $status_id
        ]);
        if (is_null($res)) {
            throw new Exception("Order not found", 404);
        }
        return $res->id;
    }

    /**
     * @param $burger
     * @param $order
     * @return void
     */
    public function registerSale($burger, $order): void
    {
        try {
            if($burger->name === "Artesanal") {
                $price =  ($burger->price_optional * count($order->options)) + $burger->price;

                Sales::create([
                    "price" => $price,
                    "order_id" => $order->id
                ]);
            } else {
                Sales::create([
                    "price" => $burger->price,
                    "order_id" => $order->id
                ]);
            }
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

}
