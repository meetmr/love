<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //完成激活页面
    public function activate(){
        $userInfo = session('user');
        if($userInfo['is_serious'] === 1 ){
            return redirect('/');
        }
        return view('index.user.activate', [
            'title' =>  '爱心社-完成个人信息',
            'userInfo'  =>$userInfo
        ]);
    }
    public function activateche(Request $request){
        $userInfo = session('user');
        $data = $request->all();
        $user =  User::find($userInfo['id']);
        $user->department = $data['department'];
        $user->class = $data['class1'];
        $user->user_name = $data['user_name'];
        $user->is_serious =1;
        $info = $user->save();
        $user =  User::find($userInfo['id'])->toArray();
        session(['user'=>$user]);
        if($info){
            $state = [
                'error' => 1,
                'msg'=> '修改完成'
            ];
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '修改失败'
            ];
            return json_encode($state);
        }
    }
    public function outlogin(){
        session(['user'=>null]);
        return redirect('/');
    }
}
