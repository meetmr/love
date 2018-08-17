<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;

class UserController extends BaseController
{
    public function userInfo(Request $request){
        if($request->isMethod('post')){
            $key = $request->post('key');
            $userInfo = User::orwhere('school_number','like','%'.$key.'%')->orwhere('user_name','like','%'.$key.'%')->paginate(15);
            return view('admin.user.user-Info',[
                'users' =>  $userInfo
            ]);
        }
        $userInfo = User::paginate(15);
        return view('admin.user.user-Info',[
            'users' =>  $userInfo
        ]);
    }
    public function delete(Request $request){
        $id = $request->post('id');
        $info = User::destroy($id);
        $state = [
            'error' => 1,
            'msg'=> '删除成功'
        ];
        if($info){
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '删除失败'
            ];
            return json_encode($state);
        }
    }
    public function edit($id){
        $user =  User::find($id)->toArray();
        $user['password'] = Crypt::decrypt($user['password']);
        return view('admin.user.user-edit',[
            'user' =>  $user
        ]);
    }
    public function cheedit(Request $request){
        $data = $request->all();
        $user =  User::find($data['id']);
        $user->user_name = $data['user_name'];
        $user->class = $data['class'];
        $user->department = $data['department'];
        $user->emal = $data['emal'];
//        $user->password =  Crypt::encrypt($data['password']);
        $info = $user->save();
        if($info){
            $state = [
                'error' => 1,
                'msg'=> '修改成功'
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
        session(['admin'=>null]);
        return redirect('/');
    }
}
