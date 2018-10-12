<?php
header('Content-Type:text/html;charset=utf-8');
/**
 * Created by PhpStorm.
 * User: @ 若雨
 * Date: 2018/9/28
 * Time: 11:11
 */

$number = array_map(function ($n){
    return $n +=1 ;
},[1,5,600]);

var_dump($number);
