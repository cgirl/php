<?php
header("Content-Type:text/html;charset=utf-8");
/**
 * __call：调用不可见（不存在或者无权限）的方法时，自动调用。
 * 例子：
 * $li->tell(1, 2, 3) -- 没有tell()方法--->__call('tell', array(1, 2, 3))运行
 *
 * __callstatic：调用不可见（不存在或者无权限）的静态方法时，自动调用。
 * 例子：
 * Human::cry('痛苦', '大哭', '啼哭'); ---没有cry方法--
 * -->Human::__callstatic('cry', array('痛苦', '大哭', '啼哭'))
 * 
 * 
 */
class Human{
    public function hell(){
        echo 'hello<br />';
    }
    
    private function pao(){
        echo '私有函数<br>';
    }
    
    public function __call($method, $argument) {
        echo '有对象想调用'.$method.'方法<br />';
        echo '参数为:<br />';
        print_r($argument);
        echo '<br><br>';
    }
    
    public static function __callstatic($method, $argument){
        echo '有对象想调用'.$method.'静态方法<br />';
        echo '参数为:<br />';
        print_r($argument);
        echo '<br><br>';
    }
}

$li = new Human();
/* 未写__call之前，下面调用报错：
 * Fatal error: Call to undefined method Human::say()
 * in F:\web\www\php\senior\128.php on line 9
 */
//$li->say();

$li->hell();
$li->tell(1, 2, 3);
$li->pao('a', 'b', 'c');
echo '<hr>';
//========================================================//
Human::cry('痛苦', '大哭', '啼哭');
echo '<hr>';
//=======================================================//
/*
 * 这个__callstatic为什么和其他函数的字体或者颜色不太一样呢？
 * 可能是php5.3里才添加的，比较新。而编辑器可能是老版本，里面没有包含新的php函数
 */
/*
 * __call在ThinkPHP中的应用
 */
class Action{
    public function bj(){
        echo 'bj天气预报';
    }
    
    public function __call($method, $argument){
        echo $method.'天气预报';
    }
}

$action = new Action();
$method = $_GET['method'];

$action->$method();
?>