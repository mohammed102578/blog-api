<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

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

//all routes / api here must be api authenticated
Route::group(['middleware' => ['checkPassword'], 'namespace' => 'API','prefix'=>'Api'], function () {
   
    //article route
    Route::post('get_articles', 'ArticleController@index');
    Route::post('article', 'ArticleController@getArticleById');
    Route::post('add_article', 'ArticleController@store');
    Route::post('update_article', 'ArticleController@update');
    Route::post('delete_article', 'ArticleController@destroy');

    //auth route
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');

//profile route
Route::post('get_profile', 'ProfileController@get_profile');
Route::post('change_password', 'ProfileController@change_password');
Route::post('change_image', 'ProfileController@change_image');
Route::post('update_profile', 'ProfileController@update_profile');


   



});

