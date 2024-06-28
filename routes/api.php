<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LendController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
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

Route::post('/lends/returned/{id}',[LendController::class,'returnedBook'])->name('lends.returned');

Route::apiResource('authors',AuthorController::class);
Route::apiResource('books',BookController::class);
Route::apiResource('lends',LendController::class)->except(array('destroy'));
Route::apiResource('sales',SaleController::class);
Route::apiResource('users',UserController::class);

