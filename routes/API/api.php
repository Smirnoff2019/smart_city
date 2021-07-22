<?php

//use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//С регистрацией и паролем (пакет passport)
//Route::post('register', 'SmartCity\RegisterController@register');
//Route::middleware('auth:api')->post('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('/user')->post('/', 'Auth\RegisterController@create');
Route::middleware('auth:api')->post('/guest', function (Request $request) {
    return $request->user();
});

Route::prefix('/user')->group(function() {

//    Route::get('/', 'SmartCity\SmartUserController@index');
//    Route::get('/{id}', 'SmartCity\SmartUserController@show');
    Route::post('/', 'SmartCity\SmartUserController@store');

});

Route::prefix('/point')->group(function() {

    Route::get('/', 'SmartCity\PointController@index');
    Route::get('/{id}', 'SmartCity\PointController@show');
    Route::post('/', 'SmartCity\PointController@store');
    Route::post('/update/{id}', 'SmartCity\PointController@update');
    Route::delete('/{id}', 'SmartCity\PointController@destroy');

});

Route::prefix('/tag')->group(function() {

    Route::get('/', 'SmartCity\TagController@index');
    Route::get('/{id}', 'SmartCity\TagController@show');
    Route::post('/', 'SmartCity\TagController@store');
    Route::post('/update/{id}', 'SmartCity\TagController@update');
    Route::delete('/{id}', 'SmartCity\TagController@destroy');

});
//
//Route::prefix('/pointTag')->group(function() {
//
//    Route::get('/', 'PointTagsController@index');
//    Route::get('/{id}', 'PointTagsController@show')->where(['id' => '[0-9+]']);
//    Route::post('/', 'PointTagsController@store');
//    Route::put('/{id}', 'PointTagsController@update')->where(['id' => '[0-9+]']);
//    Route::delete('/{id}', 'PointTagsController@delete')->where(['id' => '[0-9+]']);
//
//});
