<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchSalesByBurgerAndStatus;
use App\Models\Sales;
use App\Repositories\SalesRepository;
use Illuminate\Http\JsonResponse;

/**
 * class responsible for the collection of Sales
 */
class SalesController extends Controller
{
    private ?SalesRepository $salesRepository = null;

    /**
     * Instance the repository
     */
    public function __construct()
    {
        $this->salesRepository = new SalesRepository(new Sales());
    }

    /**
     * @param SearchSalesByBurgerAndStatus $request
     * @return JsonResponse
     */
    public function index(SearchSalesByBurgerAndStatus $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $response = $this->salesRepository->searchBurgerByNameAndStatus($data['burgerName'], $data['statusName']);
            return response()->json($response);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param SearchSalesByBurgerAndStatus $request
     * @return JsonResponse
     */
    public function getSalesWithNameBurger(SearchSalesByBurgerAndStatus $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $response = $this->salesRepository->searchBurgerByNameAndStatusWithBurgerName($data['burgerName'], $data['statusName']);
            return response()->json($response);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }
}
