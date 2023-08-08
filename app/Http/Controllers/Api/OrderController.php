<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderStatusIdRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Service\OrderService;
use Illuminate\Http\JsonResponse;

/**
 * class responsible for the collection of Order
 */
class OrderController extends Controller
{
    private ?OrderRepository $repository = null;
    private ?OrderService $service = null;

    /**
     * Instance the repository
     */
    public function __construct()
    {
        $this->repository = new OrderRepository(new Order);
        $this->service = new OrderService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $allOrders =  cache()->remember('allOrders', now()->addMinutes(10), function () {
                return $this->repository->getOrders();
            });
            return response()->json($allOrders, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param CreateOrderRequest $request
     * @return JsonResponse
     */
    public function store(CreateOrderRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $res = $this->service->create($data);
            $this->cacheClear();
            return response()->json(["data" => $res], 201);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @param UpdateOrderStatusIdRequest $request
     * @return JsonResponse
     */
    public function update(UpdateOrderStatusIdRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $res = $this->service->update($data['order_id'], $data['status_id']);
            $this->cacheClear();
            return response()->json(["data" => $res], 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getOrderRequested(): JsonResponse
    {
        try {
            $getOrderRequested =  cache()->remember('getOrderRequested', now()->addMinutes(10), function () {
                return $this->repository->getOrderRequested();
            });
            return response()->json($getOrderRequested, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getOrderInProduction(): JsonResponse
    {
        try {
            $getOrderInProduction =  cache()->remember('getOrderInProduction', now()->addMinutes(10), function () {
                return $this->repository->getOrderInProduction();
            });
            return response()->json($getOrderInProduction, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getOrderFinished(): JsonResponse
    {
        try {
            $getOrderFinished =  cache()->remember('getOrderFinished', now()->addMinutes(10), function () {
                return $this->repository->getOrderFinished();
            });
            return response()->json($getOrderFinished, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getOrderCanceled(): JsonResponse
    {
        try {
            $getOrderCanceled =  cache()->remember('getOrderCanceled', now()->addMinutes(10), function () {
                return $this->repository->getOrderCanceled();
            });
            return response()->json($getOrderCanceled, 200);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }

    /**
     * @return void
     */
    private function cacheClear(): void
    {
        cache()->forget('allOrders');
        cache()->forget('getOrderRequested');
        cache()->forget('getOrderInProduction');
        cache()->forget('getOrderFinished');
        cache()->forget('getOrderCanceled');
    }
}
