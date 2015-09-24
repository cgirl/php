<?php
/*
 * 其他基础重点笔记
 * 1.函数的命名规则和变量一样，但是函数名不区分大小写
 * 2.在函数内部使用global，表名使用全局变量（不建议使用，破坏了变量完整有效性）；
 *   超级全局变量，在页面的任何部分，包括函数、方法等，都可以直接访问，$_GET、$_POST
 * 3.动态函数：可以用变量的值当函数名
 * 4.获取时间戳:time()、microtime()
 * 5.时间戳格式化：date()
 * 6.解析检测日期：mktime()
 * 7.字符串常识
 * 
 */
header("Content-Type: text/html;charset=utf-8");

/*************时间戳格式化**************/
$time = time();
echo date('Y-m-d 星期N h:i:s', $time);
echo '<br>';
sleep(1);
echo date('Y-m-d 星期N h:i:s');

echo '<br>';
echo date('Y-m-d 星期N h:i:s', 0);
echo '<br>';
echo gmdate('Y-m-d 星期N H:i:s', 0);
echo '<br>';

/*************解析检测日期**************/
echo '<br>';
echo mktime(14,35,20,11,27,2015);
echo '<br>';
echo strtotime('now');
echo '<br>';
echo strtotime('tomorrow');
echo '<br>';
echo strtotime('now + 1 day');
echo '<br>';
var_dump(checkdate(13,2,2000));
var_dump(checkdate(12,2,2000));
echo '<br>';

/*************字符串常识**************/
echo '<br>';
//定义大段文本，可使用heredoc和nowdoc
$str3 = <<<HTML
hello
hjhJFHJHjhl
gshgdshg
yeruyuwmVBNZ
VNbvnb
HTML;
$str4 = <<<BIYJ
hello
hjhJFHJHjhl
gshgdshg,
yeruyuwmVBNZ
VNbvnb
BIYJ;

$str5 = <<<'BIYJ'
hhhhhhhhhhhhh
yyyyyyyyyyyyy
BIYJ;

echo $str3;
echo '<br>';
echo '<br>';
echo $str4;
echo '<br>';

//单双引号:单引号转义的少
echo '<br>';
$str1 = ' \' \\ \n \t \v \$';
echo $str1,'<br>';

$str2 = " \' \\ \n \t \v \$";
echo $str2,'<br>';

//双引号会解析变量值
//单引号比双引号速度要快，因为单引号能转义的字符少，且不需要解析变量的值
$str = 29;
echo '李明今年$str岁','<br>';
echo "李明今年$str岁",'<br>';

//数组键的规则：
//1.如果不声明键，默认会从0,1,2...递增来生成键
//2.如果已经在某一个或者几个数字键，则从最大的数字键，递增生成数字键
//3.如果键声明重复了，后面的值覆盖前面的值
//4.键可以是整数，也可以是字符串；浮点数转成整数，如果字符串的内容恰好是整数，也会理解为整数
$arr = array(2=>'布', 2.5=>'尔', '2'=>'教', '2.5'=>'育');
print_r($arr);
echo '<br>';

//数组游标参数：
//取当前游标指向的数组单元的值
echo '<br>';
$arr = array('a', 'b', 'c');
echo current($arr),'<br>';
next($arr);
echo current($arr),'<br>';
end($arr);
echo current($arr),'<br>';
prev($arr);
echo current($arr),'<br>';

reset($arr);
while ($v = current($arr)){
    echo $v;
    next($arr);
}
echo '<br>';

//false会跳出循环，可以使用each函数来处理
$arr1 = array(1, 2, 3, false, 4, 5, 6);
while (list($k, $v) = each($arr1)){
    echo $v;
}
echo '<br>';

//数组常用函数及面试题
echo '<br>';
$arr = array('a'=>'张龙', 'b'=>'赵虎', 'c'=>NULL);
if ( isset($arr['c'] )){
    echo 'c号单元存在';
} else {
    echo 'c号单元不存在';
}
echo '<br>';

if ( array_key_exists( 'c', $arr )){
    echo 'c号单元存在';
} else {
    echo 'c号单元不存在';
}
echo '<br>';

if (in_array('赵虎', $arr)){
    echo '赵虎存在';
} else {
    echo '赵虎不存在';
}
echo '<br>';

//数组的案例与面试题
echo '<br>';
$arr = array('a', 'b', 'c', 'd');
echo array_push($arr, 'e'); //向数组尾部加入单元，并返回操作后的数组长度
echo '<br>';
echo array_pop($arr);
echo array_pop($arr);
echo '<br>';
echo array_unshift($arr, 'z');//向数组头部加入单元，并返回操作后的数组长度
echo '<br>';
print_r($arr);
echo '<br>';
echo array_shift($arr);
echo '<br>';
print_r($arr);

//一种羊，第二年生一个小羊，第四年生一个小羊，第五年死，20年后有多少只羊。
echo '<hr>';
$yang = array(1, 0, 0, 0, 0);
for ($i=0; $i<4; $i++){
    $temp = $yang[1]+$yang[3];
    array_unshift($yang, $temp);
    array_pop($yang);
}
echo array_sum($yang), '<br>';
//n只猴子围坐成一个圈，按顺时针方向从1到n编号，然后从1号猴子开始沿顺时针方向开始报数，报到m的猴子出去；再从刚出局的猴子的下一个位置开始
//从新开始报数，如此重复，直到剩下一个猴子，她就是大王，设计并编写程序，实现如下功能：
//1.要求由用户输入开始时的猴子数为n，报数的最后一个数m
//2.给出当选猴王的初始编号
$arr = array('1','2','3','4','5','6','7');//示例数组
echo '<pre>The King is :<br/>';
print_r(king($arr,3));


function king($arr,$count){
    $i = 1;//从1开始
    while(count($arr) > 1){
        if($i%$count == 0){//用求余，计算数到的位，如果求余为0，所数到的位消除，压出数组中
            unset($arr[$i-1]);
        }else{//数到的位不是结束，把这一位放到数组末尾，并消掉这个位
            array_push($arr,$arr[$i-1]);
            unset($arr[$i-1]);
        }
        print_r($arr);
        $i++;//转移到下一个数组元素
    }
    return $arr;
}
?>