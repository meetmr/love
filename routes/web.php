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

Route::get('/','IndexController@index');
Route::get('register','IndexController@register');
Route::get('login','IndexController@login');
Route::post('register','IndexController@cheregister');
Route::post('login','IndexController@chelogin');


Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('index', 'IndexController@index');
    Route::get('welcome', 'IndexController@welcome');
    Route::get('user/info', 'UserController@userInfo');
});


Route::group(['prefix'=>'user'],function (){

    Route::get('activate', 'UserController@activate');
});
