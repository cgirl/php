<?php
header("Content-Type:text/html; charset=utf-8");

/**
 * 子类继承父类的属性/方法，可以修改和增加
 */

class sixty{
    public $wine = '1斤';
    
    public function play(){
        echo '谈理想';
    }
}

class nine extends sixty{
    public function play(){
        echo '打游戏，宅！<br />';
    }
    
    public function momo(){
        echo 'momo', '<br />';
    }
    
    public function showWine(){
        echo $this->wine, '<br />';
    }
}

$s90 = new nine();
echo $s90->wine,'<br />';  //父类有的，继承过来
$s90->play(); //父类有的继承过来，可以修改
$s90->momo(); //父类没有的，可以添加
$s90->showWine();
/*
 * 上面所说的及成果来的大环境，是指protected和public
 */

//=====================================================//
/**
 * 继承时的权限变化
 * 继承自父类的权限或者方法，其权限只能越来越宽松或者不变，不能越来越严格
 */
class Human{
    public function cry() {
        echo '55555<br />';
    }
}

class Stu extends Human{
    protected function cry(){
        echo '66666<br />';
    }
}

$stu = new Stu();
/*
 * Fatal error: Access level to Stu::cry() must be public (as in class Human)
 *  in F:\web\www\php\senior\119.php on line 53
 * 子类的cry比父类的cry方法，权限要严格
 * 这步行，继承时权限只能越来越宽松或者不变，不能越来越严格
 */
$stu->cry();

?>