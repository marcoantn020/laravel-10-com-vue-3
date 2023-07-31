<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBurgerRequest;
use App\Http\Requests\UpdateBurgerRequest;
use App\Models\Burger;
use App\Repositories\BurgerRepository;
use Illuminate\Http\JsonResponse;

class BurgerController extends Controller
{
    protected $burger = null;
    public function __construct()
    {
        $this->burger = new BurgerRepository(new Burger());
    }

    public function index(): JsonResponse
    {
        return response()->json(["data" => $this->burger->getBurger()], 200);
    }

    public function getOrderRequested(): JsonResponse
    {
        return response()->json(["data" => $this->burger->getOrderRequested()], 200);
    }

    public function getOrderInProduction(): JsonResponse
    {
        return response()->json(["data" => $this->burger->getOrderInProduction()], 200);
    }

    public function getOrderFinished(): JsonResponse
    {
        return response()->json(["data" => $this->burger->getOrderFinished()], 200);
    }

    public function getOrderCanceled(): JsonResponse
    {
        return response()->json(["data" => $this->burger->getOrderCanceled()], 200);
    }

    public function store(CreateBurgerRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['status_id'] = 1;
        $res = $this->burger->create($data);
        return response()->json(["data" => $res->id]);
    }

    public function update($id, UpdateBurgerRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->burger->update($id, $data);
        return response()->json(["data" => true], 200);
    }
}
