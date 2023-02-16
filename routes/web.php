<?php

use App\Http\Controllers\{
    ProductController,
    CommentController,
    ProfileController,
    PurchasedController
};
use Illuminate\Support\Facades\Route;
 
Route::middleware('auth')->group(function() {
    
    /**
    * Route ProductController
    */
    Route::resource('/products', ProductController::class);


    /**
    * Route PurchasedController
    */
    Route::post('/products/buy', [PurchasedController::class, 'store'])->name('products.purchased');
    Route::get('myProducts', [ProductController::class, 'myProducts'])->name('products.myProducts');  
    Route::get('myShoppings', [ProductController::class, 'myShoppings'])->name('products.myShoppings');  


    /**
    * Route CommentController
    */
    Route::post('/comment', CommentController::class)->name('products.create_comment');
    Route::get('comments/{comment}', [CommentController::class, 'comments'])->name('products.comments');

    /**
    * Route ProfileController
    */
    Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';

