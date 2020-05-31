<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function(){

	Route::get('/get/{param}','Welcome@get');	
	Route::post('/post/{param}','Welcome@post');	
	Route::put('/put/{param}','Welcome@put');
	Route::delete('/delete/{param}','Welcome@delete');
	Route::post('/raw/{param}','Welcome@raw');
});