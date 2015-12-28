<?php
header("Content-Type:text/html; charset=utf-8");

/**
 * 面向对象三大特征：
 * 封装 继承 多态
 */

class Human{
    public $money = 1000;
    
}

$lisi = new Human();
echo $lisi->money, '<br />'; //==>1000

//变一下money
$lisi->money = 500;
echo $lisi->money, '<br/>'; //==>500

/*
 * 李四的钱，别人问他有多少钱，他就如实说，别人把他的钱减少，立即减少了。
 * 如果在显示生活中，这个现象不合理。我们需要把钱保护起来
 * public是公共的，即大家都可以来读取，操作；显然，钱不应该是公共的
 */
class Human1{
    private $money = 1000;
    
    public function showmoney(){
        return $this->money * 0.8;
    }
}
$zhangsan = new Human1();
//在下例中，调用失败，因为mohney是私有的，在外部，不能被调用，这是我们就把noney封装起来了
//注意：光封起来，是没有意义的，因为money这个属性还得与外界有所交互才可以
//echo $zhangsan->money, '<br />'; //调用失败

//你不能直接翻别人口袋，看别人有多少钱；但是，可以问别人有多少钱
/*
 * 属性封装：把某些重要属性，封装起来，然后通过一些重要的接口来操作，这就实现了对属性的封装
 */
echo $zhangsan->showmoney();

//===========================================================//
class Human2{
    private $money = 1000;
    private $bank = 2000;
    private function getBank($much){
        $this->bank -= $much;
        return $much;
    }

    public function send($much){
        if($much >= $this->money+$this->bank){
            return false;
        } else if($much <= $this->money+$this->bank) {
            $num = $much-$this->money; //需要从银行取多少钱
            $this->money += $this->getBank($num);
            $this->money -= $much;
            return $much;
        } else {
            $this->money -= $much;
            return $much;
        }
        return $this->money * 0.8;
    }
    
    public function showmoney(){
        return $this->money;
    }
    
    public function showbank(){
        return $this->bank;
    }
}

$wangwu = new Human2();
$n = $wangwu->send(300);
if($n){
    echo '<br />借了'.$n.'元,', '还剩下'.$wangwu->showmoney().'元,', '银行还剩余'.$wangwu->showbank().'元。';
}

//再借2000元
$m = $wangwu->send(2000);
if ($m){
    echo '<br />借了'.$m.'元,', '还剩下'.$wangwu->showmoney().'元，', '银行还剩余'.$wangwu->showbank().'元。';
}
/*
 * 在上面的例子中个，借钱者只知道借成功了还是借失败了，至于，如果借成功了，wangwu是怎么样把钱凑齐的，借钱者会不会知道？
 * 借钱者，不会知道wangwu也许跑了趟银行，把钱凑齐
 * 
 * 就像同学们，只需要每周一到周五来听课，至于后面老师的备课，拉网线等等，你们不需要知道。
 * 
 * 对于一个兑现个，对外界开放一个借口，调用接口时，内部进行的操作不需要让外界知道，隐藏了内部的一些实现细节，
 * 这句是对方法的封装。
 */
?>