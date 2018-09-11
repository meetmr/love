<?php

namespace App\Http\Controllers\Admin;

use App\Word;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Replys;
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
        $count = count($userInfo);
        return view('admin.user.user-Info',[
            'users' =>  $userInfo,
            'count' =>  $count
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

    //留言管理
    public function replyList(){
        $words = Word::orderBy('time','edsc')->paginate(15);
        return view('admin.user.replys-info',[
            'words'    =>  $words
        ]);
    }

    public function replyDelete(Request $request){
        $id = $request->post('id');
        $info = Word::destroy($id);
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

    public function huifu($id){
        $word =  Word::find($id)->toArray();
          return view('admin.user.huifu-info',[
            'word'    =>  $word
        ]);
    }
    public function chehuifu(Request $request){
        $data = $request->post();
        $replys = new Replys;
        $replys->centent = $data['centent'];
        $replys->w_id = $data['w_id'];
        $replys->time = time();
        $replys->name = session('admin.user_name');
        $info = $replys->save();
        if($info){
            $state = [
                'error' => 1,
                'msg'=> '回复成功'
            ];
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '回复失败'
            ];
            return json_encode($state);
        }
    }
}
