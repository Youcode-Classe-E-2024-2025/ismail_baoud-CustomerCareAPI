<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ResponseController;
use App\Models\YourModel;

Route::apiResource('/tickets', TicketController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/users', [AuthController::class, 'user']);

Route::middleware('auth:sanctum')->apiResource('/responses', ResponseController::class);

Route::get('/your-endpoint', function () {
    return YourModel::all();
});
