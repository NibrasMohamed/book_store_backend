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
    Route::post('register', 'AuthenticationController@register');
    Route::post('login', 'AuthenticationController@login');
    Route::get('/get-roles', 'RoleController@getRoles');
    Route::get('/get-books', 'BooksController@index');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('logout', 'AuthenticationController@logout');

        Route::resource('authors', 'AuthorController');
        Route::post('authors/change-status/{id}', 'AuthorController@changeStatus');
        Route::resource('books', 'BooksController');
        Route::get('books/author-books/{user_id}', 'BooksController@getAuthorBooks');

    });
});

