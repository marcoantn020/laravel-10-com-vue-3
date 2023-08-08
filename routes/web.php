<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/report-traditional', [\App\Http\Controllers\EmailController::class, 'reportTraditional']);
Route::get('/report-artesanal', [\App\Http\Controllers\EmailController::class, 'reportArtesanal']);
