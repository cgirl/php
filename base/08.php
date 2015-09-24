<?php
header("Content-Type: text/html;charset=utf-8");
echo '<pre>';

$all = array(
    array('id'=>1, 'area'=>'北京', 'pid'=>0),
    array('id'=>3, 'area'=>'保定', 'pid'=>2),
    array('id'=>4, 'area'=>'易县', 'pid'=>3),
    array('id'=>5, 'area'=>'海淀', 'pid'=>1),
    array('id'=>2, 'area'=>'河北', 'pid'=>0),
    array('id'=>6, 'area'=>'上地', 'pid'=>5),
);
static $arr = array();
function myfind($array, $id){
    foreach ($array as $k=>$v){
        if ($v['pid'] == $id){
            echo '找到'.'<br>';
            global $arr;
            $arr[] = $v;
            myfind($array, $v['id']);
        } else {
            echo '没找到'.'<br>';
        }
    }
}

myfind($all, 0);
print_r($arr);
?>