<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;

class IndexController extends Controller
{
    //
    public function index(){

        return view('index.index.index',[
            'title' =>  '爱心社-川信职院'
        ]);
    }
    public function register(){
        return view('index.index.register', [
                'title' =>  '爱心社-注册'
            ]);
    }
    public function login(){
        return view('index.index.login', [
            'title' =>  '爱心社-登陆'
        ]);
    }
    public function cheregister(Request $request){
        $data = $request->all();
        if($this->che($data)){
            return $this->che($data);
        }
        $email = $data['email'];
        $school_number = $data['school_number'];
        $password =  $data['password'];
        //执行入库操作
        $user = new User();
        $user->emal = $email;
        $user->school_number = $school_number;
        $user->password = Crypt::encrypt($data['password']);
        $info = $user->save();
        if($info){
            $state = [
                'error' => 1,
                'msg'=> '注册成功'
            ];
            return json_encode($state);
        }

    }
    public function che($data){
        $email = $data['email'];
        $school_number = $data['school_number'];
        $password =  $data['password'];
        $password2 = $data['password2'];
        $checkmail="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";//定义正则表达式
        $checksch = "/^\d{8}\b/";
        $checpass= "/^\w{6,16}$/";
        if($email == '' || !preg_match($checkmail,$email)){
            $state = [
                'error' => 0,
                'msg'=> '邮箱格式不正确'
            ];
            return json_encode($state);
        }
        if($school_number == '' || !preg_match($checksch,$school_number)){
            $state = [
                'error' => 0,
                'msg'=> '学号格式不正确'
            ];
            return json_encode($state);
        }
        if($password == '' || !preg_match($checpass,$password) || $password != $password2){
            $state = [
                'error' => 0,
                'msg'=> '密码格式不对哦'
            ];
            return json_encode($state);
        }

        $is_email = count(User::where('emal', $email)->get());
        if($is_email !== 0){
            $state = [
                'error' => 0,
                'msg'=> '邮箱已经注册啦'
            ];
            return json_encode($state);
        }
        $is_school_number = count(User::where('school_number', $school_number)->get());
        if($is_school_number !== 0){
            $state = [
                'error' => 0,
                'msg'=> '学号已经注册啦'
            ];
            return json_encode($state);
        }
    }
    public function chelogin(Request $request){
        $data = $request->all();
        $school_number = $data['school_number'];
        $password =  $data['password'];
        $user = User::where('school_number',$school_number)->get();
        $user = $user->toArray();
        if(count($user) == 0){
            $state = [
                'error' => 0,
                'msg'=> '学号没有注册'
            ];
            return json_encode($state);
        }
       if(Crypt::decrypt($user[0]['password']) !== $password){
           $state = [
               'error' => 0,
               'msg'=> '密码错误'
           ];
           return json_encode($state);
       }

       session(['user'=>$user[0]]);
        if($user[0]['is_serious'] == 0){
           $state = [
               'error' => 2,
               'msg'=> '第一次登陆进入激活页面'
           ];
           return json_encode($state);
       }
        $state = [
            'error' => 1,
            'msg'=> '登陆成功'
        ];
        return json_encode($state);
    }
}
