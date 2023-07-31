<?php

use App\Http\Controllers\Api\BreadsController;
use App\Http\Controllers\Api\BurgerController;
use App\Http\Controllers\Api\IngredientsController;
use App\Http\Controllers\Api\MeatController;
use App\Http\Controllers\Api\OptionalController;
use App\Http\Controllers\Api\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("/",  [StatusController::class, 'index']);
Route::prefix("v1")->group(function () {

    Route::prefix("status")
        ->group(function () {
            Route::get("/", [StatusController::class, 'index']);
            Route::get("/{id}", [StatusController::class, 'show']);
            Route::post("/", [StatusController::class, 'store']);
        });

    Route::prefix("meat")
        ->group(function () {
            Route::get("/", [MeatController::class, 'index']);
            Route::get("/{id}", [MeatController::class, 'show']);
            Route::post("/", [MeatController::class, 'store']);
        });

    Route::prefix("breads")
        ->group(function () {
            Route::get("/", [BreadsController::class, 'index']);
            Route::get("/{id}", [BreadsController::class, 'show']);
            Route::post("/", [BreadsController::class, 'store']);
        });

    Route::prefix("optional")
        ->group(function () {
            Route::get("/", [OptionalController::class, 'index']);
            Route::get("/{id}", [OptionalController::class, 'show']);
            Route::post("/", [OptionalController::class, 'store']);
        });

    Route::prefix("burgers")
        ->group(function () {
            Route::get("/", [BurgerController::class, 'index']);
            Route::post("/", [BurgerController::class, 'store']);
            Route::patch("/{id}", [BurgerController::class, 'update']);

            Route::get("/requested", [BurgerController::class, 'getOrderRequested']);
            Route::get("/production", [BurgerController::class, 'getOrderInProduction']);
            Route::get("/finished", [BurgerController::class, 'getOrderFinished']);
            Route::get("/canceled", [BurgerController::class, 'getOrderCanceled']);
        });

    Route::prefix("ingredients")
        ->group(function () {
            Route::get("/", [IngredientsController::class, 'index']);
        });

});
