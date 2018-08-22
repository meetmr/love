<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Activity;
use App\Participate;
use App\Word;
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
    public function enroll($id){
        $id = intval($id);
        $activity = Activity::find($id);
        if($activity == null){
            return redirect('/');
        }
        $activity = $activity->toArray();
        return view('index.user.action-enroll', [
            'title' =>  '爱心社-'.$activity['activity_name'].'报名',
            'activity' =>$activity
        ]);
    }
    public function cheenroll(Request $request){
        $data = $request->all();
        $participate = new Participate();
        $participate->ac_id = $data['a_id'];
        $participate->u_id = session('user.id');
        $participate->name = $data['user_name'];
        $participate->school_number = $data['school_number'];
        $participate->class = $data['class1'];
        $participate->department = $data['department'];
        $count = countCheenroll($data['a_id']);
        $r_count = Activity::find($data['a_id'])->toArray()['number'];
        if($count == $r_count){
            $state = [
                'error' => 0,
                'msg'=> '人数已满'
            ];
            return json_encode($state);
        }
        $info = $participate->save();
        if($info){
            $state = [
                'error' => 1,
                'msg'=> '报名成功'
            ];
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '报名失败'
            ];
            return json_encode($state);
        }
    }
    public function words(){
        $words = Word::orderBy('time','desc')->paginate(15);
        return view('index.user.words', [
            'title'       =>  '爱心社-留言板',
            'words'      =>$words
        ]);
    }
    public function chewords(Request $request){
        $content = $request->post('content');
        $word = new Word();
        $word->content = $content;
        $word->u_id = session('user.id');
        $word->time = time();
        $info = $word->save();
        if($info){
            $state = [
                'error' => 1,
                'msg'=> '留言成功'
            ];
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '留言失败'
            ];
            return json_encode($state);
        }

    }
}
