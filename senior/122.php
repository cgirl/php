<?php
header("Content-Type:text/html;charset=utf-8;");

/**
 * 分析：
 * 与java那段出错的程序相比，php没有报错。因为php是弱类型动态语言，一个变量：
 * $var = b;
 * $var = 'hello';
 * $var = new Pig();
 * 一个变量没有类型，你装什么变量都行。同理，传参，参数也没有强制类型，传什么参数都可以。
 * 所以，对于php语言来说，岂止是多态，简直是变态。
 * 
 * 又有专家说，你这个太灵活了，简直是变态，不能这么灵活，否则我们就不说你是多态。
 * 我们不让php这么灵活。
 */

class Light{
    public function ons($g){
        $g->display();
    }
}

class RedGlass{
    public function display(){
        echo '红光', '<br />';
    }
}

class BlueGlass{
    public function display(){
        echo '蓝光', '<br />';
    }
}

class GreenGlass{
    public function display(){
        echo '绿光', '<br />';
    }
}

class Pig{
    public function display(){
        echo 'pig', '<br />';
    }
}

//创建一个手电筒
$light = new Light();

//创建3块玻璃
$red = new RedGlass();
$blue = new BlueGlass();
$green = new GreenGlass();

//红光
$light->ons($red);
//蓝灯
$light->ons($blue);
//绿灯
$light->ons($green);

$pig = new Pig();
//调用错了
$light->ons($pig);

//========================================================//
echo '<hr>';
/**
* 又有专家说，你这个太灵活了，简直是变态，不能这么灵活，否则我们就不说你是多态。
* 我们不让php这么灵活。
* 
* 那么对参数做限制类型
* 加类型检测后，果然不能传其他类型的玻璃
* 解决：参数定为父类，传参为其子类 (见最后一个例子)
* 哲学：子类是父类，。例如：男人是人，白马是马，蓝玻璃是玻璃
* 里氏代换：原能用父类的场合，都可以用子类来代替
*/
class Light1{
    public function ons(RedGlass $g){ //此处仿java，也加一个类型，做类型检测
        $g->display();
    }
}

class RedGlass1{
    public function display(){
        echo '红光', '<br />';
    }
}

class BlueGlass1{
    public function display(){
        echo '蓝光', '<br />';
    }
}

class GreenGlass1{
    public function display(){
        echo '绿光', '<br />';
    }
}

class Pig1{
    public function display(){
        echo 'pig', '<br />';
    }
}

//造手电筒
$light1 = new Light1();

//造玻璃
$red1 = new RedGlass1();
$blue1 = new BlueGlass1();
$green1 = new GreenGlass1();

//红光
$light1->ons($red1);
//$light1->ons($blue1); //报错
//$light1->ons($green1); //报错

//============================================================//
/**
 * 解决：参数定为父类，传参为其子类 
 * 
 * 如果就php本身特点，不检测类型；本身就可以说是多态的，甚至是变态的
 * 
 * 但是PHP5.3以上，引入了对于对象类型的参数检测，注意只能检测对象所属的类。其实这对于php来说，限制了其灵活性，
 * 才达到了java中多态的效果
 * 
 * 反思多态：
 * 其实就是，只抽象的声明父类，具体的工作由子类对象来完成，这样，不同的子类对象完成不同的特点。
 */
echo '<hr>';
class Light2{
    public function ons(Glass $g){ //此处仿java，也加一个类型，做类型检测
        $g->display();
    }
}

class Glass{
    public function display(){
        ;
    }
}

class RedGlass2 extends Glass{
    public function display(){
        echo '红光', '<br />';
    }
}

class BlueGlass2 extends Glass{
    public function display(){
        echo '蓝光', '<br />';
    }
}

class GreenGlass2 extends Glass{
    public function display(){
        echo '绿光', '<br />';
    }
}

class Pig2{
    public function display(){
        echo 'pig', '<br />';
    }
}

//造手电筒
$light2 = new Light2();

//造玻璃
$red2 = new RedGlass2();
$blue2 = new BlueGlass2();
$green2 = new GreenGlass2();

//红光
$light1->ons($red2);
$light1->ons($blue2);
$light1->ons($green2);

$pig2 = new Pig2();
$light2->ons($pig2); //报错
?>