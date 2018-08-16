<?php
header('Content-Type:text/html;charset=utf-8');
$stra = 'open_door';
$stra = 'make_by_id';
function zhuan($str){
     $art = explode("_", $str);
    $str1 = '';
     foreach ($art as $v){
         $s =  strtoupper($v[0]);
         $v[0] = $s;
         $str1 .= $v;
     }
     return $str1;
}
echo "<pre>";
var_dump(zhuan($stra));