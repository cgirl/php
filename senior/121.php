<?php
header("Content-Type:text/html; charset=utf-8");

/**
 * private
 * protected
 * public
 * 三者的区别
 * 权限==        private            protect             public
 * 本类内=           Y                  Y                   Y
 * 子类内=           N                  Y                   Y
 * 类外部=           N                  N                   Y
 * 
 * 注意：
 * 在java中，如果属性/方法前面不写任何参数，即public/protected/private都不写，也可以的，
 * 默认是friendly权限控制；而在php中，如果不写任何参数，则默认的是public。此处建议养成好习惯，
 * 尽量都写上。
 * 
 */
class Human{
    private $name = 'zhangs';
    protected $money = 22;
    public $age = 28;
    public function say(){
        echo 'Human->name='.$this->name.', money='.$this->money.', age='.$this->age.'<br />';
    }
}

class Stu extends Human{
    private $friend = 'wangw';

    public function talk() {
        echo 'Stu->name='.$this->$name.', money='.$this->money.
        ', age='.$this->age.', friend='.$this->friend.'<br />';
    }
}

$xiao = new Stu();
/*
 * 经过下面的例子：
 * public可以在类外调用，权限最为宽松，而protected和private不能再类外调用
 * public在类内调用可否？当然可以，类外都可以，权限很宽松，类内自然没有问题
 * 
 * 
 */
//echo $xiao->friend; //错误，因为类外不能调用private
//echo $xiao->money; //错误，因为类外不能调用protected属性
echo $xiao->age, '<br />'; //=>28

/*
 * 下面执行报错：
 *分析原因：
 *1）private私有属性可以继承过来，系统有标记，标记其为父类层面的私有属性，因此无权调用，导致此错发生
 *2）protected可以在子类内访问，当然也可以在本类内访问
 */
//$xiao->talk(); //不能

$yuan = new Human();
$yuan->say();
?>