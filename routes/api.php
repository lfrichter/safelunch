<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorityController;
use App\Http\Controllers\Api\EstablishmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/userinfo', [AuthController::class, 'userinfo'])->middleware('auth:sanctum');

Route::namespace('Api')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        // Authorities
        Route::get('/authority', [AuthorityController::class, 'index']);
        Route::get('/authority/{authotity}', [AuthorityController::class, 'show']);
        Route::post('/authority', [AuthorityController::class, 'store']);
        Route::put('/authority', [AuthorityController::class, 'update']);
        Route::delete('/authority/{id}', [AuthorityController::class, 'destroy']);
        // Establishments
        Route::get('/establishments/{authority_id}', [EstablishmentController::class, 'index']);
        Route::get('/establishment/{id}', [EstablishmentController::class, 'show']);
        Route::post('/establishment', [EstablishmentController::class, 'store']);
        Route::put('/establishment', [EstablishmentController::class, 'update']);
        Route::delete('/establishment/{id}', [EstablishmentController::class, 'destroy']);
    });

    Route::get('/establishment-search/{search?}', [EstablishmentController::class, 'search'])->name('api.establishments.search');
});
