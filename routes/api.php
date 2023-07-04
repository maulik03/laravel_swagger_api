<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos', [TodoListController::class, 'index']);
Route::get('/todos/{id}', [TodoListController::class, 'show']);
Route::post('/todos', [TodoListController::class, 'store']);
Route::put('/todos/{id}', [TodoListController::class, 'update']);
Route::delete('/todos/{id}', [TodoListController::class, 'destroy']);