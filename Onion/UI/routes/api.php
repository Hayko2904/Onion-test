<?php
use Illuminate\Support\Facades\Route;

// Product
Route::prefix('product')->group(function () {
    // CRUD
    Route::post('/create', 'ProductController@create');
    Route::post('/update/{product}', 'ProductController@update');
    Route::post('/delete/{product}', 'ProductController@delete');
});
