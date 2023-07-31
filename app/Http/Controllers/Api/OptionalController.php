<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BreadsTypeRequest;
use App\Http\Requests\OptionalTypeRequest;
use App\Models\Bread;
use App\Models\Optional;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;

class OptionalController extends Controller
{
    protected ?BaseRepository $optional = null;
    public function __construct()
    {
        $this->optional = new BaseRepository(new Optional());
    }

    public function index(): JsonResponse
    {
        return response()->json(["data" => $this->optional->all()], 200);
    }

    public function store(OptionalTypeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['type'] = strtolower($data['type']);
        $res = $this->optional->create($data);
        return response()->json(["id" => $res->id], 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(["data" => $this->optional->find($id)], 200);
    }
}
