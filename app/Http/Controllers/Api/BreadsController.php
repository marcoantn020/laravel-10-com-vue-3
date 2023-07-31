<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BreadsTypeRequest;
use App\Models\Bread;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;

class BreadsController extends Controller
{
    protected ?BaseRepository $bread = null;
    public function __construct()
    {
        $this->bread = new BaseRepository(new Bread());
    }

    public function index(): JsonResponse
    {
        return response()->json(["data" => $this->bread->all()], 200);
    }

    public function store(BreadsTypeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['type'] = strtolower($data['type']);
        $res = $this->bread->create($data);
        return response()->json(["id" => $res->id], 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(["data" => $this->bread->find($id)], 200);
    }
}
