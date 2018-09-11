<?php
use App\Participate;
use App\User;
/**
 * Created by PhpStorm.
 * User: moTzxx
 * Date: 2017/12/28
 * Time: 17:47
 */

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
use App\Replys;
function showMsg($id){
   echo $id.'a';
}
function is_cheenroll($a_id){
    $uid = session('user.id');
    $info = Participate::where('ac_id','=',$a_id)->where('u_id','=',$uid)->get();
    $info = count($info->toArray());
    if($info){
        return true;
    }else{
        return false;
    }
}
function countCheenroll($a_id){
    $info = Participate::where('ac_id','=',$a_id)->get();
    return (count($info));
}
function getUserName($u_id){
    $info = User::where('id','=',$u_id)->get()->toArray();
    return $info[0]['user_name'];
}
function getTime($time){
    return date('Y-m-d :H:i:s',$time);
}
function getReplys($w_id){
    $replys = Replys::where('w_id','=',$w_id)->get();
    return $replys;
}