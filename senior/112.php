<?php
header("Content-Type:text/html; charset=utf-8");

class Human{
    public $name = 'lisi';
    public function who(){
        echo $this->name;
    }
    
    public function test(){
        echo $name;
    }
}
$a = new Human();
echo $a->name, '<br />';
$a->who();

/*
 * 和java，C++相比，方法体内想访问调用者的属性，必须用$this，如果不加，则理解为方法内部的一个局部变量
 */
/**
 * 从生活中的角度来理解$this
 * 女蜗造人时，造了一个“悔恨”的方法：
 * {
 *     抓头发，抽脸
 * }
 * 世界上的人那么多，悔恨时，抓谁的头发，谁的脸？只能理解为自己
 */
?>