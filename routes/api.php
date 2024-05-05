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

// NO AUTH
Route::prefix('/auth')->group(function(){
    Route::post('/', [\App\Http\Controllers\AuthController::class, 'login']);
});
Route::get('/waiters/image/{waiter}', [\App\Http\Controllers\WaiterController::class, 'image']);
Route::get('/items/image/{item}', [\App\Http\Controllers\ItemController::class, 'image']);


// REQUIRED AUTH
Route::middleware('auth:api')->group(function(){

    Route::prefix('/users')->group(function(){
        Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile']);
        Route::patch('/profile', [\App\Http\Controllers\UserController::class, 'updateProfile']);
    });

});

Route::prefix('/dashboard')->group(function(){
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/expo/{waiter}', [\App\Http\Controllers\DashboardController::class, 'expo']);
    Route::post('/search', [\App\Http\Controllers\DashboardController::class, 'search']);
});

Route::prefix('/management')->group(function(){
    Route::get('/', [\App\Http\Controllers\ManagementController::class, 'index']);
});

Route::prefix('/items')->group(function(){
    Route::get('/', [\App\Http\Controllers\ItemController::class, 'all']);
    Route::get('/{item}', [\App\Http\Controllers\ItemController::class, 'get']);
    Route::post('/{item}', [\App\Http\Controllers\ItemController::class, 'update']);
    Route::post('/', [\App\Http\Controllers\ItemController::class, 'create']);
    Route::delete('/{item}', [\App\Http\Controllers\ItemController::class, 'delete']);
    Route::patch('/{item}/restore', [\App\Http\Controllers\ItemController::class, 'restore']);
});

Route::prefix('/waiters')->group(function(){
    Route::get('/', [\App\Http\Controllers\WaiterController::class, 'all']);
    Route::post('/', [\App\Http\Controllers\WaiterController::class, 'create']);
    Route::get('/{waiter}', [\App\Http\Controllers\WaiterController::class, 'get']);
    Route::get('/{waiter}/login', [\App\Http\Controllers\WaiterController::class, 'login']);
    Route::post('/{waiter}', [\App\Http\Controllers\WaiterController::class, 'update']);
    Route::delete('/{waiter}', [\App\Http\Controllers\WaiterController::class, 'delete']);
    Route::patch('/{waiter}/restore', [\App\Http\Controllers\WaiterController::class, 'restore']);
});

Route::prefix('/tables')->group(function(){
    Route::get('/', [\App\Http\Controllers\TableController::class, 'all']);
    Route::get('/{table}', [\App\Http\Controllers\TableController::class, 'get']);
    Route::post('/', [\App\Http\Controllers\TableController::class, 'create']);
    Route::delete('/{table}', [\App\Http\Controllers\TableController::class, 'delete']);
    Route::patch('/{table}', [\App\Http\Controllers\TableController::class, 'update']);
    Route::patch('/{table}/restore', [\App\Http\Controllers\TableController::class, 'restore']);

    Route::get('/app-table-data/{table}/{waiter}', [\App\Http\Controllers\TableController::class, 'getAppData']);
});

Route::prefix('/orders')->group(function(){
    Route::post('/', [\App\Http\Controllers\OrderController::class, 'create']);
    Route::get('/{id}', [\App\Http\Controllers\OrderController::class, 'get']);
    Route::get('/', [\App\Http\Controllers\OrderController::class, 'browse']);

    Route::patch('/{order}', [\App\Http\Controllers\OrderController::class, 'update']);
    Route::patch('/{order}/add-items', [\App\Http\Controllers\OrderController::class, 'addItems']);
});


