<?php
header("Content-Type:text/html; charset=utf-8");

/**
 * 权限方法的继承
 * 构造方法也是可以继承的，而且继承的原则和普通方法一样
 * 
 * 进而，如果子类也声明构造函数，则父类的构造函数，被覆盖了。
 * 如果父类的构造函数被覆盖了，自然，只执行子类中心得构造函数
 * 
 * 引发一个问题:
 * 如果是一个数据库操作类，或者是model类，我们肯定是要继承过去再使用，不能直接操作model类，
 * 而model类的构造函数，又做了许多初始化工作。
 * 我重写了model类的构造方法，导致初始化工作完不成了，怎么办？
 * 答：如果子类继承时，有构造函数，保险一点，要先调用parent::__construct
 * 这一点和java的面向对象，也有不同；在java中，实例化子类时，父类的构造函数运行，且先运行，然后运行子类的构造函数
 * 另外：java中构造函数不是__construct(),而是和类名相同的方法理解为构造函数。
 * 在一些教材或者老的代码中，也可能有这种情况，即与类名相同的函数做构造函数，这是php4时代的残留，请不要这么做。
 */
class Human{
    public function __construct(){
        echo '构造方法', '<br />';
    }
}

class Stu extends Human{
}
$ming = new Stu(); //显示“构造方法”,这说明构造函数也是可以继承的

class King extends Human{
    public function __construct(){
        echo '子类构造方法', '<br />';
    }
}
$caocao = new King();

echo '<hr>';
class Mysql{
    protected $conn = null;
    public function __construct() {
        $this->conn = mysql_connect('localhost', 'root', '123456');
    }
    
    public function query($sql){
        return mysql_query($sql, $this->conn);
    }
}
$mysql = new Mysql();
var_dump($mysql->query('use test'));

class MyDb extends mysql{
    public function __construct(){
        //如果子类继承时，有构造函数，保险一点，如下操作：
        parent::__construct();
        //然后在写自己的构造方法，业务逻辑
        return true;
    }
    public function autoInsert(){
        return $this->query('use test');
    }
}
$mydb = new MyDb();
var_dump($mydb->autoInsert());
?>