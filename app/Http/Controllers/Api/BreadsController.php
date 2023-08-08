<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\BreadsTypeRequest;
use App\Models\Bread;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;

/**
 * class responsible for the collection of Breads
 */
class BreadsController extends Controller
{
    protected ?BaseRepository $bread = null;

    /**
     * Instance the repository
     */
    public function __construct()
    {
        $this->bread = new BaseRepository(new Bread());
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $breads =  cache()->remember('breadsAll', now()->addMinutes(10), function () {
                return $this->bread->all();
            });

            return response()->json($breads, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param BreadsTypeRequest $request
     * @return JsonResponse
     */
    public function store(BreadsTypeRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['type'] = strtolower($data['type']);
            $res = $this->bread->create($data);
            cache()->forget('breadsAll');
            return response()->json(["id" => $res->id], 201);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        try {
            return response()->json(["data" => $this->bread->find($id)], 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }
}
