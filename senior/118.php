<?php
header("Content-Type:text/html; charset=utf-8");
/**
 * 继承时，继承者的protected/public属性/方法完全继承过来，属于子类
 * 继承的父类private属性/方法但不能操作
 * @author ibm
 */
class Human{
    private $wife = 'june';
    public $height = 160;
    public function tell(){
        echo 'this my wife:', $this->wife, '<br>';
    }
    
    public function cry() {
        echo '555555<br>';
    }
    
    public function pshow(){
        echo $this->wife,'<br />';
        print_r($this);
    }
}

class Stu extends Human{
    public function subtell(){
        echo $this->wife;
    }
}

$lisi = new Stu();
$lisi->cry();
$lisi->tell();
/*
 * 报错：Notice: Undefined property: Stu::$wife in F:\web\www\php\senior\118.php on line 17
 * 问：父类不是有wife属性么，为什么没继承过来？
 * 答：私有属性，可以理解不能继承（其实能继承过来，只不过无法访问）
 *    public prorected private中，前两个都可以继承，并拥有访问和修改的权限。这就好比说，家产已经
 *    继承过来了，愿意卖就卖，愿意改就改。而私有的，就像先祖的牌位，继承下来，但是无权动，只能供着。
 */
//$lisi->subtell();
echo '<hr />';

//============================================//
/*
 * 父类private属性方法，可以继承但是不能操作
 */
class Stu1 extends Human{
    private $wife = 'ya';
    public $age = 22;
    
    public function sshow(){
        parent::pshow();
        echo $this->wife,'<br />';
    }
}
$zhangs = new Stu1();
print_r($zhangs);
$zhangs->sshow();

/*
 * 思考，如果把Stu1中的wife ya去掉，什么效果？ //Stu1 未定义属性
 *     如果把Human中的wife june去掉，什么效果？ //Human 无权访问
 */
?>