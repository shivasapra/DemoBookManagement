<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/authUser','HomeController@demo');
Route::post('/register', 'Api\AuthController@register')->name('apiRegister');
Route::post('/login', 'Api\AuthController@login')->name('apiLogin');

Route::apiResource('/books','BooksController');
Route::delete('/books/destroyPermanently/{book}','BooksController@destroyPermanently');
Route::get('/books/restore/{book}','BooksController@restore');

