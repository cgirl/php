<?php
/*
 * 变量：
* 1：类型
* 整型，浮点型，字符串，布尔，数组，对象，NULL，资源
*
* 2：变量检测
* isset可以检测变量是否存在，对于null，isset也返回false.
* 类型检测
* 类型转换
* 打印
* 赋值
* 销毁
* 动态变量名
*/

//类型的检测
$a = null;
$c = '';

//变量的检测
if (isset($b)){
    echo '变量b存在';
} else {
    echo '变量b不存在';
}

echo '<br>';

if (isset($a)){
    echo '变量a存在';
} else {
    echo '变量a不存在';
}

echo '<br>';

if (isset($c)){
    echo '变量c存在';
} else {
    echo '变量c不存在';
}
?>