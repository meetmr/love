<?php

namespace App\Http\Controllers;

use App\Replys;
use App\User;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Activity;
use App\Participate;
use App\Word;
use App\Comment;
// 引入 composer autoload
// 导入 Intervention Image Manager Class
use Intervention\Image\ImageManager as Image;
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
        $user->icon_path = $data['icon_path'];
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
        $user = session('user');
        if($user['is_serious'] == 0){
            return redirect('user/activate');
        }
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

        if(session('user')){
            $user = session('user');
            if($user['is_serious'] == 0) {
                return redirect('user/activate');
            }
        }
        $words = Word::orderBy('time','desc')->paginate(15);
        return view('index.user.words', [
            'title'       =>  '爱心社-留言板',
            'words'      =>$words
        ]);
    }
    public function chewords(Request $request){
        $content = $request->post('content');
        if(empty($content)){
            $state = [
                'error' => 0,
                'msg'=> '不能为空'
            ];
            return json_encode($state);
        }
        $word = new Word();
        $word->content = $content;
        $word->u_id = session('user.id');
        $word->name = session('user.user_name');
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
    public function comment(Request $request){

        $data = $request->post();
        $comment = new Comment();
        $comment->a_id = $data['id'];
        $comment->name = session('user.user_name');
        $comment->content = $data['content'];
        $comment->u_id = session('user.id');
        $comment->time = time();
        $info = $comment->save();
        if($info){
            $state = [
                'error' => 1,
                'msg'=> '评论成功'
            ];
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '评论失败'
            ];
            return json_encode($state);
        }
    }
    public function replys(Request $request){
        $data = $request->post();
        $replys = new Replys();
        $replys->centent = $data['content'];
        $replys->w_id = $data['w_id'];
        $replys->time = time();
        $replys->name = session('user.user_name');
        $replys->u_id = session('user.id');
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

    public function upload(Request $request){
        $file = $request->file('file');
        if ($file->isValid()) {
            $path = $file->store(date('ymd'), 'upload_img');
                // 通过指定 driver 来创建一个 image manager 实例 (默认使用 gd)
            $manager = new Image();
            $img = $manager->make('storage/img/'.$path)->resize(200, 200);
            $img->save('storage/img/'.$path);
            return json_encode([
                'code' =>1,
                'url' =>asset('/storage/img/' . $path)
            ]);
        }
    }

}
