<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Laravel\Passport\Passport;

Route::get('/', function () {
    return view('welcome');
});
//Авторизация
Route::namespace('Admin')->group(function () {
    //Вывод формы
    Route::get('/login', 'AdminPanelController@login')->name('login');
    //Проверка пользователя
    Route::post('/login', 'AdminPanelController@postLogin')->name('postLogin');
    //Убрать куки и перейти на главную
    Route::get('/logout', 'AdminPanelController@logout')->name('logout');

});
//Административная панель
Route::namespace('Admin')->group(function () {
    //AdminPanel Route
    Route::get('/Admin/', 'AdminPanelController@home')
        ->name('Admin.layout');
    //Routes for a Points
    Route::get('Admin/points/','PointController@index')
        ->name('Admin.points.index');
    Route::get('Admin/points/create/','PointController@create')->name('Admin.points.create');
    Route::post('Admin/points/create/','PointController@store')->name('Admin.points.store');
    Route::get('Admin/points/update/{point}','PointController@edit')->name('Admin.points.edit');
    Route::post('Admin/points/update/{point}','PointController@update')->name('Admin.points.update');
    Route::get('Admin/points/show/{point}','PointController@show')->name('Admin.points.show');
    Route::delete('Admin/points/{point}','PointController@destroy')->name('Admin.points.destroy');
    //Routes for a Tags
    Route::get('Admin/tags','TagController@index')->name('Admin.tags.index');
    Route::get('Admin/tags/create','TagController@create')->name('Admin.tags.create');
    Route::post('Admin/tags/create','TagController@store')->name('Admin.tags.store');
    Route::get('Admin/tags/update/{tag}','TagController@edit')->name('Admin.tags.edit');
    Route::post('Admin/tags/update/{tag}','TagController@update')->name('Admin.tags.update');
    Route::get('Admin/tags/show/{tag}','TagController@show')->name('Admin.tags.show');
    Route::delete('Admin/tags/{tag}','TagController@destroy')->name('Admin.tags.destroy');
    //Routes for a Users
    Route::get('Admin/users/','UserController@index')->name('Admin.users.index');
    Route::get('Admin/users/create/','UserController@create')->name('Admin.users.create');
    Route::post('Admin/users/create/','UserController@store')->name('Admin.users.store');
    Route::get('Admin/users/update/{id}','UserController@edit')->name('Admin.users.edit');
    Route::post('Admin/users/update/{id}','UserController@update')->name('Admin.users.update');
    Route::get('Admin/users/show/{id}','UserController@show')->name('Admin.users.show');
    Route::delete('Admin/users/{id}','UserController@destroy')->name('Admin.users.destroy');
    //Routes for a PointsTags
    Route::get('Admin/pointTags/','PointTagsController@index')->name('Admin.pointTags.index');
    //Routes for a maps
    Route::get('Admin/maps/','MapController@index')->name('Admin.maps.index');
    Route::get('Admin/maps/show/{point}','MapController@show')->name('Admin.maps.show');
    //Routes for a upload files
});

