<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your staff. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Application;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return $apps = Application::all()->count();
});

Route::get('/apply/create','ApplicationsController@index');
Route::post('/apply','ApplicationsController@store');

Route::get('/applications', 'ApplicationsReviewController@index');
Route::get('/applications/review/{id}', 'ApplicationsReviewController@show');

Route::post('application/review','ApplicationsReviewController@update');


