<?php
header("Content-Type:text/html;charset=utf-8");
/**
 * 延迟绑定
 * static:运行期
 * const：声明期
 */
class Animal{
    const age = 2;
    public static $leg = 4;
    public static function cry(){
        echo '哭声：aoaoaoao'.'<br />';
    }
    
    public static function t1(){
        self::cry();
        echo 'age='.self::age.'<br />';
        echo 'leg='.self::$leg.'<br />';
        echo '<hr>';
    }
    
    public static function t2(){
        static::cry();
        echo 'age='.static::age.'<br />';
        echo 'leg='.static::$leg.'<br />';
        echo '<hr>';
    }
}

class lang extends Animal{
    const age = 2;
    //public static $leg = 3;
    
    public static function cry(){
        echo 'ao~ao~ao~'.'<br />';
    }
}

class zai extends lang{
    //const age = 0.5;
    public static $leg = 2;
    
    public static function cry(){
        echo '哭声：yiyiyi'.'<br />';
    }
}

zai::t1();
zai::t2();
?>