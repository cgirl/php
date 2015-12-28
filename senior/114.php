<?php
header("Content-Type:text/html;charset=utf-8");
/**
 * 权限修饰符
 * 作用：用来说明，属性/方法的权限特点
 * 只能卸载属性/方法前面
 * 
 * 共有3个权限修饰符
 * private -- 私有的
 * protected -- 保护的
 * public -- 公共的
 * 
 * 疑问：
 * 1)private修复的属性/方法，可以在哪里访问
 * 2)protected修复的属性/方法，可以在哪里访问（后续再讲）
 * 3)public修复的属性/方法，可以在哪里访问
 * 如何判断属性方法有木有权限访问？
 * 答：看访问时的位置。
 *   private的属性方法，只能在类自定义的{}内访问
 *   public的属性方法，在任意位置都可以访问
 */
class Human{
    public $mood = ''; //心情
    private $money = 1000; //钱
    
    public function showmoney(){
        return $this->money;
    }
    
    private function secret(){
        echo '我小时候偷吃过一块肉';
    }
    
    public function tellme(){
        $this->secret();
    }
}
$lisi = new Human();
$lisi->mood = 'happy'.'<br />';
echo $lisi->mood;
//echo $lisi->money;//调用位置在Human类的{}外面，因此调用失败

/* 
 * showmoney是公共的，因此可以调用，showmoney中的return $this->money;
 * 运行环境，是在{}的内部，因此有权限访问money属性
 */
echo $lisi->showmoney(), '<br />';
//$lisi->secret(); //不可以调用
$lisi->tellme(); //可以，因为是通过内部类内调用的

/**
 * 总结：private权限控制
 * 只能在类的{}内调用，走出了{}，谁也调不动
 */

//===============================//
/**
 * 看看权限控制的一个bug
 * @author ibm
 */
class Test{
    private $money = 1000;
    public function getMoney($people){
        return $people->money;
    }
    
    public function setMoney($people){
        $people->money -= 500;
    }
}

$biyj = new Test();
$houzl = new Test();
//echo $houzl->money; //不可以

echo '<br />',$biyj->getMoney($houzl);
$biyj->setMoney($houzl);
echo '<br />',$biyj->getMoney($houzl),'<br />';
print_r($houzl);
/*
 * 奇怪之处在于：houzl的钱，应该由houzl来调用getMoney和setMoney才能影响
 * 尽管和我们上面所写的原则是符合的。
 */
?>