<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('/products', ProductController::class)
    ->middleware('auth');

require __DIR__.'/auth.php';