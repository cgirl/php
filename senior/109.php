<?php 
header("Content-Type:text/html;charset=utf-8");

/**
 * 再从程序的角度/数据的角度深入分析类与对象
 * 
 * 声明类时
 */

//声明类的时候注意点
/**
 * 1：关于属性值，可以声明属性并赋值，也可以声明属性先不赋值
 *   如果不赋值，则属性的初始值为NULL
 * 2：关于PHP中的类，请注意，属性必须是一个直接的值
 *   就是8种类型任意的值，不能是表达式（1+2）的值，不能是函数的返回值（time()）
 *   这点和java不一样
 */
class Human{
    public $age = 0;
    //public $height = 30+10; //错误
    //public $time = time(); //错误
}

$a = new Human();
echo $a->age.'<br>';
//echo $a->height.'<br>';
//echo $a->time.'<br>';

class People{
    public $age;
}
$b = new People();
var_dump($b->age);
echo '<br>';

//方法注意点
function t(){
    echo 't';
}
//这个t是我的自定义函数
t();
echo '<br>';

//我再定义一个t函数
/**
 * Fatal error: Cannot redeclare time() in F:\web\www\php\senior\109.php on line 46
 * PHP中函数不能重复定义，这点和js不一样
 */
/* function t(){
    echo 'time';
}
t(); */

/**
 * 但是类中的方法，可以理解为“包在类范围内的函数”，和全局的函数不是一回事，因此可以重名
 */
class clock{
    public function time(){
        echo '现在的时间戳是aaaa';
    }
    
    public function time2(){
        echo '现在的时间戳是:',time(),'<br>'; //注意此处调用的是系统的time()函数
        echo $this->t(); //此处调用的是自身的t函数
    }
    
    public function t(){
        return '内部的t';
    }
}

$c = new clock();
$c->time();
echo '<br>';
$c->time2();
?>