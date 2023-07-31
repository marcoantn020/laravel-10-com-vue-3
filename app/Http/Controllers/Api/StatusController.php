<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusTypeRequest;
use App\Models\Status;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected ?BaseRepository $status = null;
    public function __construct()
    {
        $this->status = new BaseRepository(new Status());
    }

    public function index(): JsonResponse
    {
        return response()->json(["data" => $this->status->all()], 200);
    }

    public function store(StatusTypeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['type'] = strtolower($data['type']);
        $res = $this->status->create($data);
        return response()->json(["id" => $res->id], 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(["data" => $this->status->find($id)], 200);
    }
}
