<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/items')->group(function(){
    Route::get('/', [\App\Http\Controllers\ItemController::class, 'all']);
    Route::get('/{item}', [\App\Http\Controllers\ItemController::class, 'get']);
    Route::post('/{item}', [\App\Http\Controllers\ItemController::class, 'update']);
    Route::post('/', [\App\Http\Controllers\ItemController::class, 'create']);
    Route::get('/image/{item}', [\App\Http\Controllers\ItemController::class, 'image']);
    Route::delete('/{item}', [\App\Http\Controllers\ItemController::class, 'delete']);
});


Route::prefix('/waiters')->group(function(){
    Route::get('/', [\App\Http\Controllers\WaiterController::class, 'all']);
    Route::post('/', [\App\Http\Controllers\WaiterController::class, 'create']);
    Route::get('/{waiter}', [\App\Http\Controllers\WaiterController::class, 'get']);
    Route::post('/{waiter}', [\App\Http\Controllers\WaiterController::class, 'update']);
    Route::delete('/{waiter}', [\App\Http\Controllers\WaiterController::class, 'delete']);
    Route::get('/image/{waiter}', [\App\Http\Controllers\WaiterController::class, 'image']);
});


Route::prefix('/tables')->group(function(){
    Route::get('/', [\App\Http\Controllers\TableController::class, 'all']);
    Route::get('/{table}', [\App\Http\Controllers\TableController::class, 'get']);
    Route::post('/', [\App\Http\Controllers\TableController::class, 'create']);
    Route::delete('/{table}', [\App\Http\Controllers\TableController::class, 'delete']);
    Route::patch('/{table}', [\App\Http\Controllers\TableController::class, 'update']);
});

Route::prefix('/orders')->group(function(){
    Route::post('/', [\App\Http\Controllers\OrderController::class, 'create']);
    Route::get('/', [\App\Http\Controllers\OrderController::class, 'browse']);
    Route::get('/{order}', [\App\Http\Controllers\OrderController::class, 'get']);
});


