<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
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

    Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/', [ProfileController::class, 'edit'])->name('profile.edit');
});


require __DIR__.'/auth.php';