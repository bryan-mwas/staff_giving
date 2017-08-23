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
use App\Application;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return $apps = Application::all()->count();
});

Route::get('/applications/create','ApplicationsController@create');
Route::post('/applications','ApplicationsController@store');
Route::get('/applications', 'ApplicationRecommendationsController@index');

Route::get('/recommendations/{id}', 'ApplicationRecommendationsController@show');
Route::post('recommendations','ApplicationRecommendationsController@create');


