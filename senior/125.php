<?php
header("Content-Type:text/html;charset=utf-8");
echo '<pre>';
/**
 * 单例模式
 * 先看场景：
 *    多人协同开发，都要调用mysql类的实例；如果用svn，好多人一起开发，再提交各自的文件。
 * A:
 * $mysql = new mysql();
 * ...自测通过
 * B:
 * $db = new mysql();
 * ...自测通过
 * 
 * A与B的代码要合并到一起：
 * $mysql = new mysql();
 * ...
 * $db = new mysql();
 * ...
 * 
 * 这样就存在了两个mysql的实例，而且，每次new一下，都要连接一次数据库。
 * 显然，一个页面有一个mysql实例就够了，如果限制，让多人开发，无论你怎么操作，只能得到一个对象呢？
 * 
 * 1：开会时，经理说：有一个$db变量，是系统自动生成的，就是mysql类的实例，大家都用他，谁敢new mysql()，开除
 * 2：这是行政手段，不能阻止技术上的new mysql()行为。实际上，可以使用单例模式来解决
 * 
 * 注：单例模式常用也常考，请认真练习。
 */

/*=============================================================================
 * 第一步：一个普通的类，这个普通的类，可以new来实例化。如下：这显然不是单例
 */
class single1{
    //...;
}
$s1 = new single1();
$s2 = new single1();
$s3 = new single1();

/*=============================================================================
 * 第二步：看来new是罪恶之源，干脆不让new了，我们把构造方法保护或者私有。但是引出一个问题，不能new，那得不到对象，
 * 这不是单例，这是零例模式。
 */
class single2{
    protected function __construct(){
        //...;
    }
}
//$s12 = new single2();

/*=============================================================================
 * 第三步：通过内部的static方法来调用
 */
class single3{
    public $hash; //随机码
    protected function __construct(){
        $this->hash = mt_rand(1, 99999);
    }

    static public function getInstance(){
        return new self();
    }
}
//两个对象什么时间相等？答：只有指向一个对象的时候，才相等。
$s13 =  single3::getInstance();
$s23 =  single3::getInstance();
print_r($s13);echo '<br />';
print_r($s23);echo '<br />';
if($s13 == $s23){
    echo '是同一个对象';
} else {
    echo '不是同一个对象';
}

/*=============================================================================
 * 第四步：通过内部的static方法实例化，并且，把实例保存在类内部的静态属性上
 */
echo '<hr>';
class single4{
    public $hash; //随机码
    static protected $ins = null;
    protected function __construct(){
        $this->hash = mt_rand(1, 99999);
    }

    static public function getInstance(){
        //instance实例  instanceof 谁的  =>专门判断某个对象是不是某个类的实例
        if (self::$ins instanceof self){
            return self::$ins;
        }
        self::$ins = new self();
        return self::$ins;
    }
}
//两个对象什么时间相等？答：只有指向一个对象的时候，才相等。
$s14 =  single4::getInstance();
$s24 =  single4::getInstance();
print_r($s14);echo '<br />';
print_r($s24);echo '<br />';
if($s14 == $s24){
    echo '是同一个对象';
} else {
    echo '不是同一个对象';
}

/*==============================================================
 * 思路问题
 * 问题1:我们辛苦写的单例，继承一下就不灵了，如何操作？
 * 解决方案：
 * 使用final解决
 */
echo '<hr>';
class test extends single4{
    public function __construct(){
        parent::__construct();
    }
}
$test1 = new test();
$test2 = new test();
print_r($test1);
print_r($test2);

/*==============================================================
 * 解决方案：
 * 使用final解决
 * 这个关键词，在PHP中，可以修饰类，方法名，但不能修饰属性；
 * 在java中，final也可以修饰属性，此时属性值就是一个常量，不可修改。
 * 
 * final修饰类，则此类不能被继承；
 * final修饰方法，此方法不影响继承，但是不能重写
 * 
 * 问：php类中，可不可以有常量
 * 答：有
*/

/* final class Human{
    
}
class Stu extends Human{
    
} */

/*
 * 上面报错：
 * Fatal error: Class Stu may not inherit from final class (Human) in
 * F:\web\www\php\senior\125.php on line 138
 */
echo '<hr>';
class Human{
    final public function say(){
        echo '华夏子孙';
    }
    
    public function show(){
        echo 'hah';
    }
}
class Stu extends Human{
    
}
$wei = new Stu();
$wei->say(); //final方法可以被继承

//出错
/* class Freshman extends Stu{
    public function say() {
        echo '我要出国';
    }
} */

/*==============================================================
 * 思考问题的答案
 */
echo '<hr>';
class single5{
    public $hash; //随机码
    static protected $ins = null;
    final protected function __construct(){
        $this->hash = mt_rand(1, 99999);
    }

    static public function getInstance(){
        //instance实例  instanceof 谁的  =>专门判断某个对象是不是某个类的实例
        if (self::$ins instanceof self){
            return self::$ins;
        }
        self::$ins = new self();
        return self::$ins;
    }
}

class t extends single5{
   /* protected function __construct(){
        ;
    } 不允许重写*/
}
$t1 = t::getInstance();
$t2 = t::getInstance();
print_r($t1);
print_r($t2);
$t3 = clone $t2;
$t4 = $t2;

if($t1 === $t2){
    echo '是同一个对象';
} else {
    echo '不是同一个对象';
}
echo '<br />';
if($t3 === $t2){
    echo '是同一个对象';
} else {
    echo '不是同一个对象';
}
echo '<br />';
if($t4 == $t2){
    echo '是同一个对象';
} else {
    echo '不是同一个对象';
}

//如上，clone又多出一个对象，试问，如何解决？
//提示：请看魔术方法 clone
//魔术方法很多，__construct,__destruct,__clone,__callstatic....
?>