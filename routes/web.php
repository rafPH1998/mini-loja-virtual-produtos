<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
 
Route::middleware('auth')->group(function() {
    Route::resource('/products', ProductController::class);
    
    Route::get('myProducts', [ProductController::class, 'myProducts'])
            ->name('products.myProducts');  
});


require __DIR__.'/auth.php';