<?php
header("Content-Type:text/html;charset=utf-8");
/**
 * 普通常量：define('常量名', '常量值');
 * 以前说过：define定义的常量，全局有效
 * 无论是页面内，函数内，均可以访问。
 * 
 * 那能否定义专门在类内发挥作用的常量？
 * 专门在类内发挥作用，则说明：
 * 1）作用域在类内，类似于今天属性
 * 2）又是常量，则不可修改
 * 其实就是不可改变的静态属性
 * 
 * 类常量在类内直接用const修饰即可，前面不需要加其他修饰符，权限是public，即外部也可以访问
 */
define('ACC', 'Deny');
class Human{
    const HEAD = 1;
    public static $leg = 2;
    public static function show(){
        echo ACC,'<br />';
        echo self::HEAD,'<br />';
        echo self::$leg,'<br />';
    }
}
Human::show();
echo Human::HEAD;
echo '<hr>';

//============================================================//
/**
 * 魔术常量：
 * 1）无法手动修改他的值，所以叫常量
 * 2）但是值又岁环境变动的，所以叫魔术
 * 综上所述，所以叫魔术常量
 * __FILE__ 返回当前文件的路径，在框架开发或者网站初始化脚本中，用来记录网站的根目录
 * __LINE__ 返回当前的行号，在框架中，可以用来在debug时，记录错误信息
 * __CLASS__ 返回当前的类名
 * __METHOD__ 返回当前的方法名
 */
echo '当前正在运行的是 '.__FILE__.'<br />';
echo '当前在'.__DIR__.'目录下<br />';
echo 'hi,我在'.__LINE__.'行<br />';
echo 'he,我在'.__LINE__.'行<br />';
echo 'ha,我在'.__LINE__.'行<br />';

class Human1{
    public static function t(){
        echo '你正在运行'.__CLASS__.'类<br />';
        echo '下的'.__METHOD__.'方法';
    }
}
Human1::t();
echo '<hr>';

//====================================================//
/**
 * 后期绑定及延迟绑定
 * 
 */
class Human2{
    public static function whoami(){
        echo '来自父类的whoami在执行<br>';
    }
    
    public static function say(){
        self::whoami(); //子类内没有say方法，找到了父类的这里，在这里的self指的是父类
    }
    
    public static function say2(){
        //子类内也没有say方法，又找到了父类的这里，但是父类用static::whoami，指调用子类自己的whoami方法
        static::whoami();
    }
}

class Stu extends Human2{
    public static function whoami(){
        echo '来自子类的whoami在执行<br>';
    }
}

Stu::say();
Stu::say2();
?>