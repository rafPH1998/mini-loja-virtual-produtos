<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('/products', ProductController::class)
    ->middleware('auth');

Route::get('myProducts', [ProductController::class, 'myProducts'])->name('products.myProducts');   

require __DIR__.'/auth.php';