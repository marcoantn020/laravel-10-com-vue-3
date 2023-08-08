<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatusTypeRequest;
use App\Models\Status;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;

/**
 * class responsible for the collection of Status
 */
class StatusController extends Controller
{
    protected ?BaseRepository $status = null;

    /**
     * Instance the repository
     */
    public function __construct()
    {
        $this->status = new BaseRepository(new Status());
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $statusAll =  cache()->remember('statusAll', now()->addMinutes(10), function () {
                return $this->status->all();
            });

            return response()->json($statusAll, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param StatusTypeRequest $request
     * @return JsonResponse
     */
    public function store(StatusTypeRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['type'] = strtolower($data['type']);
            $res = $this->status->create($data);
            cache()->forget('statusAll');
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
            return response()->json(["data" => $this->status->find($id)], 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }
}
