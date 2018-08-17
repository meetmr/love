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
Route::get('admin/login','Admin\IndexController@login');
Route::post('admin/login','Admin\IndexController@chelogin');


Route::group(['middleware'=>['web','admin.admin'],'prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('index', 'IndexController@index');
    Route::get('welcome', 'IndexController@welcome');
    Route::get('user/info', 'UserController@userInfo');
    Route::post('user/delete', 'UserController@delete');
    Route::post('user/info', 'UserController@userInfo');
    Route::get('user/{id}/edit', 'UserController@edit');
    Route::post('user/edit', 'UserController@cheedit');
    Route::get('outlogin', 'UserController@outlogin');


});


Route::group(['middleware'=>['web','admin.login'],'prefix'=>'user'],function (){
    Route::get('activate', 'UserController@activate');
    Route::get('outlogin', 'UserController@outlogin');
    Route::post('activate','UserController@activateche');

});
