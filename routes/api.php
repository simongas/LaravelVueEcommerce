<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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




Route::prefix('products')->group(function (){
    Route::get('all', 'api\ProductsController@index');
    Route::middleware('auth:api')->post('create', 'api\ProductsController@store');
    Route::middleware('auth:api')->post('update', 'api\ProductsController@update');
    Route::middleware('auth:api')->get('delete/{id}', 'api\ProductsController@delete');
    Route::get('/{slug}', 'api\ProductsController@slug');
});

Route::prefix('users')->group(function (){
    Route::post('login', 'Api\LoginController@login');
    Route::middleware('auth:api')->get('all', 'api\UsersController@index');
    Route::middleware('auth:api')->get('current', 'api\UsersController@currentUser');
    Route::middleware('auth:api')->get('delete/{id}', 'api\UsersController@delete');
    Route::middleware('auth:api')->post('create', 'api\UsersController@store');
    Route::middleware('auth:api')->post('update', 'api\UsersController@update');
});

//Route::middleware('auth:api')->get('/users', function (Request $request) {
//    return $request->user();
//});3