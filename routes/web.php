<?php

use App\Http\Controllers\{
    AddressController,
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
    Route::post('/products/buy', [PurchasedController::class, 'store'])->name('products.purchased');
    Route::get('myProducts', [ProductController::class, 'myProducts'])->name('products.myProducts');  

     /**
    * Route AddressController
    */
    Route::get('/address', [AddressController::class, 'create'])->name('address.create');
    Route::post('/address', [AddressController::class, 'store'])->name('address.store');

    /**
    * Route CommentController
    */
    Route::post('/comment', CommentController::class)->name('products.create_comment');
    Route::get('comments/{comment}', [CommentController::class, 'comments'])->name('products.comments');

    Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/', [ProfileController::class, 'edit'])->name('profile.edit');
});


require __DIR__.'/auth.php';