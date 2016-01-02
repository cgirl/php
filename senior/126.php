<?php
header("Content-Type:text/html;charset=utf-8");
echo '<pre>';
/* 回顾
 * 单例模式：
 * 主要思想：
 * 1.保护或者私有构造函数，防止外部实例化
 * 2.内部开放一个公共的静态方法，负责实例化
 * 3.类由一个静态属性存放对象
 * 当静态属性已经存放对象，直接return该对象
 */

/**
 * 魔术方法：是指某些情况下，会自动调用的方法，称为模式方法。
 * php面向对象中，提供了这几个魔术方法（他们的特点都是以双下划线__开头的）：
 * __construct, __destruct,__call(),__callStatic(),__get(),
 * __set(),__isset(),__unset(),__sleep(),__wakeup(),___toString(),
 * __invoke(),__set_state(),__clone()
 * 
 * __construct：构造方法
 * __destruct：析构方法
 * 
 * __clone：克隆方法，当对象被克隆时，将会自动调用
 */
class Human{
    public $age = 22;
    
    public function __clone(){
        echo '有人克隆！假冒';
    }
}
$lisi = new Human();
$zhangs = clone $lisi;
echo '<hr>';

//======================================================//
/**
 * 接下来讲6个，在项目中，尤其是自己想写框架时，很实用的几个函数
 * __call(),__callStatic(),__get(), __set(),__isset(),__unset(),
 */
class Human1{
    private $money = '30两';
    protected $age = 20;
    public $name = '卷子';
}

$juanzi = new Human1();
echo $juanzi->name, '<br />';
//echo $juanzi->age, '<br />'; //权限报错
//echo $juanzi->sister; //Undefined property
echo '<hr>';

//========================================================//
class Human2{
    private $money = '30两';
    protected $age = 20;
    public $name = '卷子';
    
    public function __get($property){
        echo '你想访问我的'.$property.'属性'.'<br />';
    }
}

$wei = new Human2();
echo $wei->name, '<br />'; //卷子
echo $wei->age; //你想访问我的age属性
/* 总结
 * 当我们调用一个权限上不允许调用或者不存在的属性时，__get魔术方法会自动调用，并且自动传参，
 * 参数值是属性名
 * 
 * 流程：
 * $wei->age--无权-->__get(age);
 * $wei->friend--没有此属性-->__get(friend);
 * 
 * 生活中，你帮别人看小卖店:
 * 买牙刷=》好，给你牙刷
 * 买毛巾=》好，给你毛巾
 * 这个POS机挺好=》POS机是商店的工具，私有的，不卖的“你无权买”，但是我们用__get方法
 * 就有一个友好的处理机会
 * 
 * 系统直接报错，甚至fatal error，通过__get，我们就能自定义用户访问时的处理行为。
 */
echo $wei->money; //你想访问我的money属性
echo $wei->friend; //你想访问我的friend属性
echo '<hr>';

//=====================================================//
$wei->aaa = 111;
$wei->bbb = 222;
print_r($wei);
/* 这竟然给加上了
 * 其实对象就是一个属性集，在js中更明显
 * 如果这么随便就能加了属性，导致这个对象属性过多，不好管理
 */
echo '<hr>';
class Stu{
    private $money = '30两';
    protected $age = 20;
    public $name = 'mm';
    
    public function __set($p, $b) {
        echo '你想设置我们的'.$p.'属性';
        echo '且值是'.$b.'<br />';
    }
}
$qiang = new Stu();
$qiang->aaa = 111;
print_r($qiang);
$qiang->name = 'qiang';
$qiang->age = 23;
$qiang->money = '40两';
print_r($qiang);
/* 总结：
 * 如上，__set的作用：当为无权操作的属性赋值时，或者不存在的属性赋值时，__set()自动调用
 * 且自动传参，分别是属性和属性值
 * 例：
 * $qiang->age=23 --无权-->set('age', 23);
 */
echo '<hr>';
//======================================================//
/* __isset和__unset
 * __isset方法，当用isset()判断对象不可见的属性（protected/private/不存在）时，
 * 会引发__isset()来执行
 * 问：isset($obj->xyz)属性为真，能说明类声明了一个xyz属性么？
 * 答：不能。
 */
class Dog{
    public $leg = 4;
    protected $bone = '骨头';
    public function __isset($p) {
        echo '你想判断我的'.$p.'属性是否存在'.'<br />';
        return 1;
    }
    
    public function __unset($p){
        echo '你想去掉我的'.$p.'?<br>';
    }
}
$hua = new Dog();
if (isset($hua->leg)){
    echo $hua->leg, '<br />';
}
if (isset($hua->tail)){
    echo 'tail=';
    //echo $hua->tail;
} else {
    echo '没有tail';
}
echo '<hr>';
//======================================================//
echo 'unset测试'.'<br>';
print_r($hua);
unset($hua->leg);
print_r($hua);

unset($hua->tail);
unset($hua->bone);
/* 总结：
 * 当用unset销毁对象的不可见属性时，会引发__unset();
 * unset(tail)--没有tail属性-->__unset('tail');
 */
?>