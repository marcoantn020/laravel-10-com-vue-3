<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MeatTypeRequest;
use App\Models\Meat;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;

/**
 * class responsible for the collection of Meat
 */
class MeatController extends Controller
{
    protected ?BaseRepository $meat = null;

    /**
     * Instance the repository
     */
    public function __construct()
    {
        $this->meat = new BaseRepository(new Meat());
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $meatAll =  cache()->remember('meatAll', now()->addMinutes(10), function () {
                return $this->meat->all();
            });

            return response()->json($meatAll, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param MeatTypeRequest $request
     * @return JsonResponse
     */
    public function store(MeatTypeRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['type'] = strtolower($data['type']);
            $res = $this->meat->create($data);
            cache()->forget('meatAll');
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
            return response()->json(["data" => $this->meat->find($id)], 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }
}
