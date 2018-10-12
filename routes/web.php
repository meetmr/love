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

use Illuminate\Support\Facades\Mail;
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

Route::get('about/{id}','AboutController@infoList');
// 忘记密码
Route::get('retrieve/','IndexController@retrieve');
Route::post('retrieve/','IndexController@cheretrieve');

// 关于我们
Route::get('about','AboutController@info');

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

    //留言管理
    Route::get('replys/list', 'UserController@replyList');
    Route::POST('replys/delete', 'UserController@replyDelete');
    Route::get('replys/{id}/huifu', 'UserController@huifu');
    Route::post('replys/huifu', 'UserController@chehuifu');


    // 关于我们
    Route::get('about/list', 'AboutController@listInfo');
    Route::get('about/add', 'AboutController@add');
    Route::post('about/up', 'AboutController@upload');
    Route::post('about/add', 'AboutController@cheadd');


});


Route::group(['middleware'=>['web','admin.login'],'prefix'=>'user'],function (){
    Route::get('activate', 'UserController@activate');
    Route::get('outlogin', 'UserController@outlogin');
    Route::get('enroll/{id}', 'UserController@enroll');
    Route::post('enroll', 'UserController@cheenroll');
    Route::post('activate','UserController@activateche');
    Route::post('words','UserController@chewords');
    Route::post('comment', 'UserController@comment');
    Route::post('replys', 'UserController@replys');
    Route::post('up', 'UserController@upload');

    // 修改用户资料相关操作
    Route::get('edit', 'UserController@editUser');
    Route::post('edit', 'UserController@cheEditUser');

});

Route::get('mal',function (){
    $flag = Mail::send('emails.ces',['name'=>'24252'],function($message){
        $to = '83466349@qq.com';
        $message ->to($to)->subject('测试邮件');
    });
    dd($flag);;
    if($flag){
        echo '发送邮件成功，请查收！';
    }else{
        echo '发送邮件失败，请重试！';
    }


});