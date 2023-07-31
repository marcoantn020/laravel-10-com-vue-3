<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeatTypeRequest;
use App\Models\Meat;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;

class MeatController extends Controller
{
    protected ?BaseRepository $meat = null;
    public function __construct()
    {
        $this->meat = new BaseRepository(new Meat());
    }

    public function index(): JsonResponse
    {
        return response()->json(["data" => $this->meat->all()], 200);
    }

    public function store(MeatTypeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['type'] = strtolower($data['type']);
        $res = $this->meat->create($data);
        return response()->json(["id" => $res->id], 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(["data" => $this->meat->find($id)], 200);
    }
}
