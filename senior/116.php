<?php
header("Content-Type:text/html; charset=utf-8");

/**
 * Mysql封装类
 * 目标：
 * 链接数据库
 * 发送查询
 * 对于select型，返回查询数据
 * 关闭mysql连接
 */
/*
 * 思路：首先得连接，连接就得有参数
 * 参数如何传？
 * 答：
 *   1.可以用配置文件，当网站大了，肯定会有配置文件
 *   2.可以通过构造函数传参
 *   建议用1，但我们目前仅仅是写一个简单类
 */
class Mysql{
    private $host;
    private $user;
    private $passwd;
    private $dbName;
    private $charset;
    private $conn; //用来保存连接的资源
    
    public function __construct(){
        //应该在构造方法里，读取配置文件，然后根据配置文件来设置私有属性；此处还没有配置文件，直接赋值
        $this->host = 'localhost';
        $this->user = 'root';
        $this->passwd = '123456';
        $this->dbName = 'test';
        $this->charset = 'utf8';
        
        //连接数据库
        $this->connect($this->host, $this->user, $this->passwd);
        //选择数据库
        $this->switchDb($this->dbName);
        //设置字符集
        $this->setChar($this->charset);
    }
    
    //负责连接
    private function connect($h, $u, $p){
        $conn = mysql_connect($h, $u, $p);
        $this->conn = $conn;
    }
    
    //负责设置字符集
    public function setChar($char){
        $sql = 'set names '.$char;
        $this->query($sql);
    }
    
    //负责切换数据库，网站大的时候，可能用到不止一个库
    public function switchDb($db){
        $sql = 'use '.$db;
        $this->query($sql);
    }
    
    //负责发送sql查询语句
    public function query($sql) {
        return mysql_query($sql, $this->conn);
    }
    
    //负责获取多行多列的select结果
    public function getAll($sql){
        $list = array();
        $res = $this->query($sql);
        if (!$res){
            return false;
        }
        
        while ($row = mysql_fetch_assoc($res)) {
            $list[] = $row;
        }
        return $list;
    }
    
    //负责获取一行的select结果
    public function getRow($sql){
        $res = $this->query($sql);
        if (!$res){
            return false;
        }
        return mysql_fetch_assoc($res);
    }
    
    //获取一个单个的值
    public function getOne($sql){
        $res = $this->query($sql);
        if (!$res){
            return false;
        }
        $row = mysql_fetch_row($res);
        return $row[0];
    }
    
    public function close(){
        mysql_close($this->conn);
    }
}

$mysql = new Mysql();
/* print_r($mysql);

$sql = "insert into stu values (4, 'zhangsp', 'zhangsp04')";

if($mysql->query($sql)){
    echo 'yes';
} else {
    echo 'no';
} */

$sql1 = 'select * from stu';
$row = $mysql->getAll($sql1);
print_r($row);

$sql2 = 'select * from stu where id = 1';
$row2 = $mysql->getRow($sql2);
print_r($row2);

$sql2 = 'select count(*) from stu';
$row3 = $mysql->getOne($sql2);
print_r($row3);

/**
 * 至此，一个简单的mysql封装类，完成。
 * 改进：
 *   insert update操作，都需要大量的拼接字符串，能否给定一个数组，数组键->列，数组值->列的值，然后自动
 *   生成insert语句。
 */
?>