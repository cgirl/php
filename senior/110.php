<?php 
header("Content-Type:text/html;charset=utf-8");
/**
 * 回顾
 * 面向对象的哲学
 * 类与对象的概念
 * 写类的基本语法
 * 声明属性与方法时的注意点
 * 
 * 属性：只能是直接的量，不能是表达式的运算结果与函数返回值，也可以不为属性赋值，则为NULL
 * 方法：方法被包在类中，与外部函数，可以重名，不冲突
 */

/**
 * 构造函数：__construct()
 */

class Human{
    public $name = '李四';
    public $gender = '男';
}

$a = new Human();
$b = new Human();
$c = new Human();

echo $a->name, '<br>';
echo $b->name, '<br>';
echo $c->name, '<br>';

echo $a->gender, '<br>';
echo $b->gender, '<br>';
echo $c->gender, '<br>';
/**
 * 上面的例子中，体现出类是模板，对象根据模板造出的实例；但是，模板是固定的；
 * 因此，导致造出来的对象，各种属性值都一样，这显示与显示生活中的逻辑不符
 * 
 * 比如：新生儿，性别、姓名、体重，这些都不一样
 * 
 * 同一个模板，不同的对象，这就是一对矛盾？
 * 
 * 想一想，为什么新生儿有的是男，有的事女？
 * 答：因为染色体不一样。xy->男； xx->女
 *    造对象时，传x染色体，还是y染色体，都有可能
 *    这就说明创建对象时，可以传参
 * 在类中，有一个构造函数，就是用来初始化对象用的。利用构造函数，你有机会操作对象，并有机会改变他的值
 */

/* 
 * 构造函数：__construct(); 注意前面是两个下划线
 * 构造函数的作用时机：每当new一个对象，就会自动新new出来的对象发挥作用
 * new ClassName($args);
 * $arg参数原样传给构造方法，然后构造方法，用参数来影响新创建的对象；当然，也可以不传参数（但要注意，$args要与构造
 * 方法里的参数一致）
 */

//1.单纯构造函数
class gouzao {
    public function __construct(){
        echo '诞生了！', '<br />';
    }
    public $name = null;
    public $gender = null;
}
$aa = new gouzao();

//2.内置默认参数
class gouzao_guding {
    public function __construct(){
        $this->name = 'lisi';
        $this->gender = '女';
    }
    public $name = null;
    public $gender = null;
}
$aaa = new gouzao_guding();
$bbb = new gouzao_guding();
$ccc = new gouzao_guding();

echo $aaa->name, '<br />';
echo $bbb->name, '<br />';
echo $ccc->name, '<br />';

//3.带参构造
class gouzao_canshu {
    public function __construct($name, $gender){
        $this->name = $name;
        $this->gender = $gender;
    }
    public $name = null;
    public $gender = null;
}
$ab = new gouzao_canshu('张飞', '男');
$bc = new gouzao_canshu('小乔', '女');
$cd = new gouzao_canshu('曹操', '男');
$de = new gouzao_canshu();

echo $ab->name, '<br />';
echo $bc->name, '<br />';
echo $cd->name, '<br />';

/**
 * 析构函数：__destruct()
 * 构造函数是在对象产生时，自动执行
 * 析构函数是在对象销毁时，自动执行
 * 
 * 构造函数就是出生时的啼哭
 * 析构函数就是林中遗言
 */
/* 
 * 对象如何销毁？
 * 1：显示的销毁：unset,赋值为NULL，都可以
 * 2：PHP是脚本语言，在代码执行到最后一行，所有申请的内存都要释放掉；自然，对象的那段内存也要释放，对象也就被销毁了
 * 对PHP所做的WEB程序，想内存泄露，也不是新手就能做到的
 */
class xigou {
    public $name = null;
    public $gender = null;
    public function __construct(){
        echo '出生了', '<br />';
    }
    public function __destruct(){
        echo '要走了', '<br />';
    }
}
$x = new xigou();
$y = new xigou();
$z = new xigou();
$r = new xigou();

unset($x);
$y = false;
$z = NULL;
echo '<hr />';
?>