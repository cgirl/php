<?php
/*
 * 算术运算符
 * 1.算术
 * 2.比较
 * 3.三元
 * 4.逻辑
 * 5.递增递减
 * 6.字符串
 * 7.赋值
 */

header("Content-Type: text/html;charset=utf-8");

/***********1.算术注意点***********/
//除数不能为0
$a = 10;
$b = 0;
//echo $a/$b;

//如果整数溢出自动转为float
$a = 3200000000000000000000000;
$b = 3200000000000000000000000;
$c = $a + $b;
var_dump($c);
echo '<br>';

//在取模算法时，结果的正负值只取决于于被除数
$a = -10;
$b = -3;
echo $a % $b;
echo '<br>';

/***********2.比较运算符***********/
echo '<br>';
//凡运算，必有运算结果，比较运算符的运算结果是布尔类型
$a = 5;
$b = 3;
$c = ($a > $b);
var_dump($c);
echo '<br>';

$c = ($a == $b);
var_dump($c);
echo '<br>';

//===全等于:要求类型相等且值相等
$a = 5;
$b = '5';
var_dump($a == $b);
echo '<br>';
var_dump($a === $b);
echo '<br>';

//res表示查找字符串的位置
$res = 0;
if ($res === false){
    echo '未找到';
} else {
    echo '找到';
}
echo '<br>';

/***********3.三元运算符***********/
echo '<br>';
$a = 15;
$b = 10;
$c = 6;
echo ($a>$b ? $a:$b);
echo '<br>';
echo ($c<($a<$b ? $a:$b))?$c:($a<$b ? $a:$b);
echo '<br>';

/***********4.逻辑运算符***********/
echo '<br>';
$house = true;
$car = false;
if ($house == true && $car == true){
    echo '今天我要嫁给你';
} else {
    echo '分手快乐';
}
echo '<br>';

if ($house == true || $car == true){
    echo '今天我要嫁给你';
} else {
    echo '分手快乐';
}
echo '<br>';

/***********5.递增递减运算符***********/
echo '<br>';
$b = 5;
$a = $b++;
var_dump($a, $b);
echo '<br>';

$b = 5;
$a = $b--;
var_dump($a, $b);
echo '<br>';

$b = 5;
$a = ++$b;
var_dump($a, $b);
echo '<br>';

$b = 5;
$a = --$b;
var_dump($a, $b);
echo '<br>';

/***********6.字符串运算符***********/
echo '<br>';
$a = 'hello';
$b = 'world';
$c = $a.' '.$b;
var_dump($c);
echo '<br>';

$d = 112;
$c = $c.' '.$d;
var_dump($c);
echo '<br>';

echo $a,$b; //运行速度更快
echo '~~~';
echo $a.$b; //多了一步拼接的过程，运行速度会慢一些
echo '<br>';

/***********7.赋值运算符***********/
echo '<br>';
$a = 3;
$res = ($a = 3);
var_dump($res);
?>