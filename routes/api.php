<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\API'], function () {
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'RegisterController@login');

    Route::group([], function(){
        // Route::get('/users', 'UserController@getAllUsers');
        Route::resource('authors', 'AuthorController');
        Route::resource('books', 'BooksController');

    });
});

