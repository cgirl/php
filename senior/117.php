<?php
header("Content-Type:text/html; charset=utf-8");
/*
 * 回顾：
 *    封装的概念：可以通过权限修饰符，把某些属性封装在类内部，并通过制定的公共接口来访问
 *    还有，调用某个公共方法时，该公共方法可能调用在内部多个方法，但是调用者不需要知道内部的调用过程。
 * 
 * pravite与public如何区分：
 * 就看调用私有private属性/方法的那就话，发生在类的{}内还是类的{}外面
 */

/**
 * 继承的概念
 * 继承时权限的变量
 * 
 * 继承：是指以一个类为父类，另一个类可以作为其子类，子类在继承了父类的属性/方法的基础上，进一步进行修改
 * 语法：extends
 * 子类 extends 父类{}
 * 注意点：子类只能继承自一个父类
 */

class Human{
    private $height = 160;
    
    public function cry(){
        echo '5555', '<br />';
    }
}

class Stu{
    private $height = 170;
    private $snum = '0134';
    
    public function cry(){
        echo 'yingyingying', '<br />';
    }
    
    public function study() {
        echo 'study', '<br />';
    }
}

class laver{
    private $height = '180';
    private $area = '经济案件';
    
    public function cry(){
        echo 'aaaa', '<br />';
    }
    
    public function defend(){
        echo '赢了', '<br />';
    }
}

$bj = new Human();
$bj->cry();

$xiaoming = new Stu();
$xiaoming->cry();
$xiaoming->study();

$lizhuang = new laver();
$lizhuang->cry();
$lizhuang->defend();

//==============================================//
/*
 * 人和律师归根揭底还是人，自然，人的属性和方法，也一样会拥有；
 * 学生和律师，虽然是人，但是比人还多了一些自己的属性和方法。
 * 而我们目前写的3个类，完成了第2点，即有原始人的属性，有有学生和律师的独特属性；
 * 但没有很好的利用上第一点，既然是人，那默认就应该有人的属性，何必在多声明一次呢？这里的代码就已经冗余
 * 如何达到，学生和律师默认就有人的属性，达到代码的重用和简洁？当然可以使用继承
 */

//在声明一个学生类，学生本质上还是人，只不过是人类中稍微特殊一点的一个群体。即人类的基础上，衍生出来的学生类
class Stu1 extends Human{
    
}

class laver1{
    private $height = '180';
    private $area = '经济案件';

    public function cry(){
        echo 'aaaa', '<br />';
    }

    public function defend(){
        echo '赢了', '<br />';
    }
}
echo '<hr>';

$ren = new Human();
$ren->cry();

$lili = new Stu1();
$lili->cry();
//$lili->laugh(); 调用失败
/*
 * 思考：
 * 在学生类中，cry和laugh方法都没有定义，为什么cry方法调用成功，而laugh调用失败？
 * 这是因为，学生类继承自Human类
 * 在现实中，继承的例子更多
 * 比如，你同事高富帅，某天开了个宝马，他没有宝马，但是他爹有宝马。
 */
?>