<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Service\ServiceIngredients;
use Illuminate\Http\JsonResponse;

/**
 * class responsible for the collection of Ingredients
 */
class IngredientsController extends Controller
{
    protected ?ServiceIngredients $serviceIngredients = null;

    /**
     * Instance the repository
     */
    public function __construct()
    {
        $this->serviceIngredients = new ServiceIngredients();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            cache()->forget('ingredients');
            $ingredients =  cache()->remember('ingredients', now()->addHours(10), function () {
                return $this->serviceIngredients->ingredients();
            });

            return response()->json($ingredients);
        } catch (\Exception $e) {
            return ErrorResponse::errorResponse($e);
        }
    }
}
