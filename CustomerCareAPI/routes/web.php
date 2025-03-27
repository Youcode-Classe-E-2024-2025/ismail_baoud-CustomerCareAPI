<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/{any}', function () {
    return view('welcome'); // Serve the React app for all routes
})->where('any', '.*');
