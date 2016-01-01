<?php
header("content-Type:text/html;charset=utf-8");

/**
 * 总结self，parent的用法
 * self     代表本类自身(不要理解为本对象)
 * parent   代表父类
 * 在引入自身的静态属性/静态方法，以及父类的方法时，可以用到
 * 
 * 用法：
 *    self::静态属性
 *    self::静态方法
 *    parent::属性
 *    parent::方法
 */
class Human{
    static $header = 1;
    
    public function say() {
        echo Human::$header, '<br />';
    }
}

echo Human::$header, '<br />';
$lisi = new Human();
$lisi->say();

//某一天类名要统一，规范化，Human不叫Human，而叫cHuman。这样导致类及类内部的，
//凡引用到自身类型的也要改
echo '<hr>';
class Human1{
    static $header = 2;

    public function say() {
        echo self::$header, '<br />';
    }
    
    public function show(){
        echo 'hello', '<br />';
    }
}

echo Human1::$header, '<br />';
$lisi = new Human1();
$lisi->say();

echo'<hr>';
class Stu extends Human1{
    static public $header = 3;
    
    public function say(){
        echo self::$header, '<br />';
        echo parent::$header, '<br />';
    }
    
    public function myshow(){
        $this->show();
    }
    
    public function pshow(){
        parent::show();
    }
}

$ming = new Stu();
$ming->say();
$ming->show(); //hello;因为stu把Human1的show方法继承过来了

/*
 * 下面2个调用，显示效果一样的：
 * 1）如果从速度角度看，理论上parent::稍快一点点
 *   因为$this先在子类寻找show方法，寻找不到，再去父类寻找
 * 2）从面向对象的角度看，继承过来的就是自己的，$this更符合面向对象的思想。
 * 
 * 举一个反例：
 * class a{
 * }
 * 
 * class b extends a{
 * }
 * 
 * class c extends b{
 * }
 * ...
 * class n extends n-1{
 *     parent::parent::...parent::方法;
 *     总结不能这样写吧？
 * }
 */
echo '<hr>';
$juan = new Stu();
$juan->myshow();
$juan->pshow();
?>