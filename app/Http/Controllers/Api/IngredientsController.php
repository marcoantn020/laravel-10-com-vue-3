<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\ServiceIngredients;

class IngredientsController extends Controller
{
    protected ?ServiceIngredients $serviceIngredients = null;
    public function __construct()
    {
        $this->serviceIngredients = new ServiceIngredients();
    }

    public function index()
    {
        $ingredients = $this->serviceIngredients->ingredients();
        return response()
            ->json($ingredients);
    }
}
