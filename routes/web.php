<?php

use App\Http\Controllers\{
    AddressController,
    ProductController,
    CommentController,
    ProfileController
};
use Illuminate\Support\Facades\Route;
 
Route::middleware('auth')->group(function() {
    /**
    * Route ProductController
    */
    Route::resource('/products', ProductController::class);
    Route::get('myProducts', [ProductController::class, 'myProducts'])->name('products.myProducts');  

     /**
    * Route AddressController
    */
    Route::get('/address', AddressController::class)->name('address.create');
    Route::post('/address', AddressController::class)->name('address.store');

    /**
    * Route CommentController
    */
    Route::post('/comment', CommentController::class)->name('products.create_comment');
    Route::get('comments/{comment}', [CommentController::class, 'comments'])->name('products.comments');

    Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/', [ProfileController::class, 'edit'])->name('profile.edit');
});


require __DIR__.'/auth.php';