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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::group(['middleware' => 'admin'], function() {

  Route::resource('admin/dashboard', 'DashboardController');
  Route::resource('admin/user_2', 'Customer_niController');
  Route::post('admin/user_2/post_update', 'Customer_niController@post_update');
  Route::get('admin/user_2_search', 'Customer_niController@user_2_search');
  Route::get('api/get_chart', 'DashboardController@get_chart');


});
