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
    return redirect('/login');
});

Route::get('/redirect', 'RedirectsController@index');

Route::get('/applications/create','ApplicationsController@create');
Route::get('/applications/{user}','ApplicationsController@show');
Route::post('/applications','ApplicationsController@store');
Route::get('/applications', 'ApplicationsController@index');

Route::get('/financial-aid/recommend/{application}', 'FinancialAidRecommendationsController@show');  // Route model binding! Yayy!
Route::post('/financial-aid/recommend','FinancialAidRecommendationsController@store');

// Committee
Route::get('/committee/recommend/{application}', 'StaffCommitteeRecommendationsController@show');
Route::post('/committee/recommend', 'StaffCommitteeRecommendationsController@store');

