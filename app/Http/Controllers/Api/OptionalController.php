<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\BreadsTypeRequest;
use App\Http\Requests\OptionalTypeRequest;
use App\Models\Bread;
use App\Models\Optional;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;

/**
 * class responsible for the collection of Optional
 */
class OptionalController extends Controller
{
    protected ?BaseRepository $optional = null;

    /**
     * Instance the repository
     */
    public function __construct()
    {
        $this->optional = new BaseRepository(new Optional());
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $optionalAll =  cache()->remember('optionalAll', now()->addMinutes(10), function () {
                return $this->optional->all();
            });

            return response()->json($optionalAll, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param OptionalTypeRequest $request
     * @return JsonResponse
     */
    public function store(OptionalTypeRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['type'] = strtolower($data['type']);
            $res = $this->optional->create($data);
            cache()->forget('optionalAll');
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
            return response()->json(["data" => $this->optional->find($id)], 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }
}
