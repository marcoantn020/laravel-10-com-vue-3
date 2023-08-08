<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBurgerRequest;
use App\Http\Requests\UpdateBurgerRequest;
use App\Models\Burger;
use App\Repositories\BaseRepository;
use App\Repositories\BurgerRepository;
use Illuminate\Http\JsonResponse;

/**
 * class responsible for the collection of Burger
 */
class BurgerController extends Controller
{
    protected ?BaseRepository $burger = null;

    /**
     * Instance the repository
     */
    public function __construct()
    {
        $this->burger = new BurgerRepository(new Burger());
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $burgerAll =  cache()->remember('burgerAll', now()->addMinutes(10), function () {
                return $this->burger->all();
            });

            return response()->json($burgerAll, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param CreateBurgerRequest $request
     * @return JsonResponse
     */
    public function store(CreateBurgerRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['name'] = strtolower($data['name']);
            $res = $this->burger->create($data);
            cache()->forget('burgerAll');
            return response()->json(["data" => $res->id],201);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param $id
     * @param UpdateBurgerRequest $request
     * @return JsonResponse
     */
    public function update($id, UpdateBurgerRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->burger->update($id, $data);
            cache()->forget('burgerAll');
            return response()->json(["data" => true], 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @return JsonResponse
     */
    public function searchBurgerByName(): JsonResponse
    {
        try {
            $data = request()->validate([
                "burgerName" => 'required|string'
            ]);
            return response()->json($this->burger->searchBurgerByName($data['burgerName']), 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }
}
