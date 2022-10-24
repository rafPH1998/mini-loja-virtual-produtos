<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('/products', ProductController::class)
    ->middleware('auth');;

// Route::get('/products', function () {
//     return view('indexProduct');
// })->middleware(['auth']);


// Route::get('/add', function () {
//     return view('add');
// });

// Route::get('/show', function () {
//     return view('show');
// });

// Route::get('/product', function () {
//     return view('product');
// });


require __DIR__.'/auth.php';