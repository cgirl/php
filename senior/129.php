<?php
header("Content-Type:text/html;charset=utf-8");

/*
 * 回顾：
 * 魔术方法：
 * __get/__set/__isset/__unset/__call/__callstatic/__clone
 * 
 * 新知识：
 * 魔术常量、类常量
 * 抽象方法
 * 接口
 * 
 * 重写/覆盖(override)：是指子类重写了父类的同名方法
 * 重载(overload)：是指存在多个同名方法，但是参数类型或者个数不同，调用时传入不同的参数，则
 * 调用不同的相应方法。
 * 在php中，允许存在多个同名方法，因此不能够完成java/c++中的这种重载；
 * 但是php的灵活性，能达到类似的效果
 */
class Human{
    public function say($name) {
        echo $name.'吃了吗？<br />';
    }
}

class Stu extends Human{
    public function say($name){
        echo 'hello<br />';
    }
}

$xiao = new Stu();
$xiao->say('ming'); //上面这个过程叫重写override
echo '<hr>';
//========================================================//

class Calc{
    public function area(){
        //判断一个调用area时得到的参数个数
        $args = func_get_args();
        if (count($args) == 0){
            return '你想计算啥？<br />';
        }elseif (count($args) == 1){
            return 3.14*$args[0]*$args[0].'<br />';
        }elseif (count($args) == 2){
            return $args[0]*$args[1].'<br />';
        }else {
            return '啥形状？不会计算！<br />';
        }
    }
}

$calc = new Calc();
echo $calc->area();
echo $calc->area(10);
echo $calc->area(10, 20);
echo $calc->area(10, 20, 30);
?>