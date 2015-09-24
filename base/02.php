<?php
/*
 * 变量：
 * 赋值
 * 6：销毁：
 *   unset
 * 
 * 7:动态变量名：
 *   用变量的值在做变量名
 */

header("Content-Type: text/html;charset=utf-8");
//变量销毁
$a = 99;
$b = &$a;
if(isset($a)){
    echo 'a存在！'.'<br>';
    unset($a);
}
if(isset($a)){
    echo 'a存在！'.'<br>';
} else {
    echo 'a不存在！'.'<br>';
}
if(isset($b)){
    echo 'b存在！'.'<br>';
} else {
    echo 'b不存在！'.'<br>';
}

//动态变量名：用变量的值在做变量名
$liubei = '河北人';
$laoda = 'liubei';
$paihang = 'laoda';
echo '<br>';
echo $laoda;
echo '<br>';
echo ${$laoda};
echo '<br>';
echo $$$paihang;
?>