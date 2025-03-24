<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/tickets',TicketController::class);
