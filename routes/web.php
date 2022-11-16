<?php

use App\Http\Controllers\NotifyProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
 
Route::middleware('auth')->group(function() {
    /**
    * Route ProductController
    */
    Route::resource('/products', ProductController::class);
    Route::get('myProducts', [ProductController::class, 'myProducts'])->name('products.myProducts');  

    /**
    * Route CommentController
    */
    Route::post('/comment', CommentController::class)->name('products.create_comment');
    Route::get('comments/{comment}', [CommentController::class, 'comments'])->name('products.comments');
});


require __DIR__.'/auth.php';