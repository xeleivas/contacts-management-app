<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;

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


/**
 * Authentication Routes
 */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

/**
 * Contacts Routes
 */
Route::get('/contacts', [ContactController::class, 'list'])->middleware('auth:sanctum');
Route::post('/contacts/create', [ContactController::class, 'store'])->middleware('auth:sanctum');
Route::put('/contacts/{id}', [ContactController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->middleware('auth:sanctum');
