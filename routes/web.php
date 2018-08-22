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
Route::get('action','IndexController@action');
Route::get('action/{id}','IndexController@activatecheInfo');
Route::get('words','UserController@words');

Route::group(['middleware'=>['web','admin.admin'],'prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('index', 'IndexController@index');
    Route::get('welcome', 'IndexController@welcome');
    Route::get('user/info', 'UserController@userInfo');
    Route::post('user/delete', 'UserController@delete');
    Route::post('user/info', 'UserController@userInfo');
    Route::get('user/{id}/edit', 'UserController@edit');
    Route::post('user/edit', 'UserController@cheedit');
    Route::get('outlogin', 'UserController@outlogin');
    //活动相关
    Route::get('activity/index', 'ActivityController@index');
    Route::get('activity/add', 'ActivityController@add');
    Route::post('activity/add', 'ActivityController@cheAdd');
    Route::get('activity/info/{id}', 'ActivityController@info');
    Route::get('activity/edit/{id}', 'ActivityController@edit');
    Route::post('activity/edit', 'ActivityController@cheedit');
    Route::post('activity/delete', 'ActivityController@delete');
    Route::post('activity/over', 'ActivityController@over');
    Route::post('activity/deleteA', 'ActivityController@deleteA');
    Route::post('activity/deleteA', 'ActivityController@deleteA');

    //生成活动名单
    Route::get('activity/export/{id}', 'ActivityController@export');

});


Route::group(['middleware'=>['web','admin.login'],'prefix'=>'user'],function (){
    Route::get('activate', 'UserController@activate');
    Route::get('outlogin', 'UserController@outlogin');
    Route::get('enroll/{id}', 'UserController@enroll');
    Route::post('enroll', 'UserController@cheenroll');
    Route::post('activate','UserController@activateche');
    Route::post('words','UserController@chewords');

});
