<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

use App\Activity;
use App\Participate;
class ActivityController extends BaseController
{
    public function index(){
        $activits = Activity::orderBy('id','desc')->paginate(15);
        return view('admin.activity.acti-Info',[
            'activits'  =>  $activits
        ]);
    }
    public function add(){
        return view('admin.activity.add');
    }
    public function cheAdd(Request $request){
        $data = $request->all();
        $activity = new Activity();
        $activity->activity_name = $data['activity_name'];
        $activity->start_time = $data['start_time'];
        $activity->number = $data['number'];
        $activity->activity_type = $data['activity_type'];
        $activity->participant = $data['participant'];
        $activity->place = $data['place'];
        $activity->activity_content = $data['activity_content'];
        $info = $activity->save();
        $state = [
            'error' => 1,
            'msg'=> '添加成功'
        ];
        if($info){
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '添加失败'
            ];
        }
    }
    function info($id){
        $id = intval($id);
        $participateInfo  = Participate::where('ac_id','=',$id)->get();
        $count = countCheenroll($id);
        return view('admin.activity.info',[
            'participateInfo'  =>  $participateInfo,
            'count'    =>  $count
        ]);
    }
}
