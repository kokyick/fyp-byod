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
    return view('app/index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/viewindex', 'HomeController@viewindex')->name('viewindex');
Route::get('/viewindex1', 'HomeController@viewindex1')->name('viewindex1');
Route::get('/viewcart', 'HomeController@viewcart')->name('viewcart');
Route::get('/viewfeedback', 'HomeController@viewfeedback')->name('viewfeedback');
Route::get('/viewterms', 'HomeController@viewterms')->name('viewterms');
Route::get('/registration', 'HomeController@viewregistration')->name('registration');
Route::get('/login', 'HomeController@viewlogin')->name('login');


Route::get('/menus/{id}', 'RestaurantController@viewmenus')->name('menus');
Route::get('/singlemenus/{id}','RestaurantController@viewfooditem')->name('singlemenus');

Route::get('/getrestaurant', 'RestaurantController@getrestaurant')->name('getrestaurant');


Route::post('/addcart/', 'CartController@AddCart')->name('addcart');

Route::post('/dologin/', 'AccountController@login')->name('dologin');
Route::post('/doregister/', 'AccountController@register')->name('doregister');
Route::get('/dologout/', 'AccountController@logout')->name('dologout');