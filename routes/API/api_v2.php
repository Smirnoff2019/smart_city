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

Route::prefix('/user')->group(function () {

    //реализация API точек связаных с пользователем
    Route::get('/{id}/points', 'SmartCity\UsersPointController@getPoints');
    Route::post('/{id}/points', 'SmartCity\UsersPointController@createPoints');
    Route::delete('/{user_id}/points/{id}', 'SmartCity\UsersPointController@deletePoints');

    //реализация API лайков связаных с пользователем
    Route::get('/{id}/likes', 'SmartCity\V2\UserLikesController@index');
    Route::post('/{id}/likes', 'SmartCity\V2\UserLikesController@create');
    Route::delete('/{user_id}/likes/{id}', 'SmartCity\V2\UserLikesController@destroy');

});

Route::prefix('/point')->group(function () {

    //реализация API пользователей связаных с точкой
    Route::get('/{id}/user', 'SmartCity\PointsUserController@getUsers');
//    Route::post('/{id}/user', 'SmartCity\PointsUserController@createUsers');
//    Route::delete('/{id}/user', 'SmartCity\PointsUserController@deleteUsers');

    //реализация точек с лайками
    Route::get('/likes', 'SmartCity\V2\PointLikesController@index');
});



