<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * 疑问：
 *   1.把对象赋值为其他，比如true，会不会销毁？
 *   2.为什么销毁一个，空2个，最后一个出现在灰线下面？
 *     最后一次销毁，是PHP的页面执行完毕了，hr哪行也指向完毕了，然后系统回收，最后一个变量才会销毁
 *     因此，显示在hr灰线之后。
 */
/*
 * 对象的垃圾回收机制 
 * 
 */
class Human {
    public $name = '张三';
    public $gender = null;
    public function __destruct(){
        echo '要走了', '<br />';
    }
}
$a = new Human();
$b = $c = $d = $a;

echo $b->name, '<br />';
echo $a->name, '<br />';
$b->name = '李四';
echo $b->name, '<br />';
echo $a->name, '<br />';

unset($a); //因为还有$b,$c,$d在指向对象，因此对象不能销毁
echo '<hr />';

/*
 * 1:死几次？
 * 2：灰线下几次？
 */

//在此处，页面运行完毕，对象销毁，执行析构函数

$e = $f = $g = new Human();
unset($e);
echo 'unset e <br>';
unset($f);
echo 'unset f <br>';
unset($g);
echo 'unset g <br>';
echo '<hr />';
?>