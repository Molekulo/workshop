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

Route::get('/', 'HomeController@index');

Route::resource('services', 'ServicesController')->middleware(['checkClient', 'auth']);
Route::resource('cars', 'CarsController')->middleware(['checkAdmin', 'auth']);
Route::resource('bookings', 'BookingsController')->middleware('auth');

Route::post('car_service', 'CarServiceController@store')->middleware('auth');
Route::put('car_service/{id}', 'CarServiceController@update')->middleware('auth');
Route::get('car_service', 'HomeController@index');

Route::post('register_user', 'UsersController@store');
Route::get('register_user', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('api/cars', 'Api\CarsController@index');
Route::get('api/all_cars', 'Api\CarsController@all');

Route::get('api/services', 'Api\ServicesController@index');

Route::post('api/bookings', 'BookingsController@store');