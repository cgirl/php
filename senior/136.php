<?php
header("COntent-Type:text/html;charset=utf-8");

error_reporting(0);
class mysql{
    protected $conn = NULL;
    
    public function __construct() {
        $this->conn = @mysql_connect('localhost', 'root', '13456');
        if (!$this->conn){
            //发卫星报告;
            //在php中，卫星是规定好的一种对象；哪个类的对象，Exception类的对象
            //new Exception('错误原因', 错误代码)
            $e = new Exception('漏油了', 7);
            throw $e;
        }
    }
}

try { //捕捉错误信息
    $mysql = new mysql(); //返回mysql对象，并且自动连上了数据库
} catch (Exception $e) {
    echo '错误代码：'.$e->getCode().'<br />';
    echo '错误信息：'.$e->getMessage().'<br />';
    echo '错误文件：'.$e->getFile().'<br />';
    echo '错误行号：'.$e->getLine().'<br />';
}

/*
 * 疑问：我怎么判断连接成功了没有？
 * 答：返回对象后，打印对象的$conn属性，来判断
 * 
 * 需要两个步骤：
 * 1）new mysql
 * 2）做if($mysql->conn){}的判断
 * 
 * 思考：我们以前用函数时，都是返回一个值，用值来判断各种情况
 * 比如，返回true/false代表成功/失败
 * 现在我们用返回值，还行不行？
 */
if($mysql instanceof mysql){
    echo '对象创建成功，大概连接成功<br />';
} else {
    echo '对象创建成功，大概连接失败<br />';
}
?>