<?php
header("Content-Type:text/html;charset=utf-8");

/**
 * 静态属性
 * 静态方法
 * 在属性和方法前加static修饰，即可称为静态属性或静态方法。
 */

class Human{
    static public $head = 1;
    public function changeHead() {
        Human::$head = 9;
    }
    
    public function getHead() {
        return Human::$head;
    }
}

//现在没有对象，想访问静态的$head属性
/*
 * 普通属性包在对象内，用  对象->属性名  来访问
 * 静态属性放在类内，如何访问？
 * 静态属性既然存放在类空间内，那么：
 * 1.类声明完毕，该属性就已经存在，不需要依赖于对象而访问
 * 2.类在内存中只有一个，因此静态属性也只有一个
 */

//当一个对象都没有，静态属性也已随类声明而存在
echo Human::$head, '<br />';

//静态属性只有一个，为所有的对象所共有
$m1 = new Human();
$m1->changeHead(); //某个人改变了人来的头的数量

$m2 = new Human();
echo $m2->getHead(), '<br />'; 

$m3 = new Human();
echo $m3->getHead(), '<br />';

//=====================================================//
/**
 * 静态方法
 * static public/proteced/private function t(){}
 * 
 * 普通方法是存在类内的，只有1份；
 * 静态方法也是存在类内的，也只有1份
 * 区别在于：普通方法需要对象去调动，需要绑定this；而静态方法不属于哪个对象，因此不需要绑定$this，直接通过类名即可调用
 * 
 */
echo '<hr>';
class Human1{
    public $name = 'xiaoer';
    static public function cry(){
        echo '55555', '<br />';
    }
    
    public function eat(){
        echo 'chichichi', '<br />';
    }
    
    public function intro(){
        echo $this->name, '<br />';
    }
}
Human1::cry();

/*
 * Strict standards: Non-static method Human1::eat() should not be called statically in F:\web\www\php\senior\123.php 
 * on line 64
 * 下面这个eat方法是一个非静态方法，尽管没有报错，只有一个提示，但是应由对象来调用
 */
//Human1::eat();

/*
 * 接上，但从逻辑来解释，如果用类名静态调用非静态方法，比如intro()，那么$this到底是指哪个对象？
 * 因此，直接报：
 * Fatal error: Using $this when not in object context in 
 * F:\web\www\php\senior\123.php on line 65
 * 不能静态调用非静态方法
 */
//Human1::intro();

/*
 * 如上分析，其实非静态方法，是不能由类名静态调用的，但是在PHP中的面向对象检测中，并不是很严格，
 * 只要该方法没有$this，就会转化静态方法来调用。因此eat可以调用
 * 但是，在PHP5.3的strict级别下或者PHP5.4的默认级别下，
 * 都已经对类型::非静态方法做了提示
 */

$lisi = new Human1();
$lisi->cry();
?>