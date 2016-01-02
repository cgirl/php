<?php
header("Content-Type:text/html;charset=utf-8");

/**
 * 抽象类：无法实例化
 * 类前加 abstract，此类就成为抽象类，无法实例化。
 * 
 * 春秋战国时期，燕零七 飞行器专家，能工巧匠。
 * 他写了一份图纸 --- 飞行器制造术
 * 飞行器秘制图谱：
 * 1）要有一个有力的发动机，喷气式
 * 2）要有一个平衡舵，掌握平衡
 * 他的孙子问：发动机怎么造？
 * 燕零七眼望夕阳：我是造不出来，但我相信后代有人造出来
 */

//燕零七的构想，当时的科技造不出来，即这个类智能在图纸上，无法实例化。此时这个类没有具体的实现方法，
//还太抽象，因此我们把他做成一个抽象类
abstract class FlyIdea{
    /*
     * Fatal error: Abstract function FlyIdea::engine() cannot contain 
     * body in F:\web\www\php\senior\131.php on line 23
     * abstract public function engine(){
       }
     * 注意：抽象方法，不能有方法体
     */
    //大力引擎，当时也没法做，这个方法也实现不了，因此也是抽象的
    public abstract function engine();
    //平衡舵
    public abstract function balance();
}

/*
 *  Fatal error: Cannot instantiate abstract class FlyIdea 
 *  in F:\web\www\php\senior\131.php on line 33
 *  抽象类不能new来实例化
 *  下面的实例化会报错
 */
//$kongke = new FlyIdea();

//到了明朝，万户用火箭解决了发动机的问题
abstract class Rocket extends FlyIdea{
    //万户把engine方法实现了，不在抽象了
    public function engine(){
        echo '点燃火药，失去平衡，砰~！<br>';
    }
    
    //但是万户实现不了平衡舵，因此平衡舵对于Recket来说，还是抽象的，类也是抽象的，类前要加abstract
    /*
     * Fatal error: Class Rocket contains 1 abstract method and must 
     * therefore be declared abstract or implement the remaining methods 
     * (FlyIdea::balance) in F:\web\www\php\senior\131.php on line 52
     */
}

//到了现代，燕十八亲自制作飞行器
//这个fly类中，所有抽象方法都已经实现了，不再是梦想
class Fly extends Rocket{
    public function engine(){
        echo '>>>>>>>>>>>>>>>>>>用力一扔>>>>>>>>>>>>>>>>><br />';
    }
    
    public function balance() {
        echo '======两个翅膀保持平衡';
    }
    
    public function start(){
        $this->engine();
        for ($i=0; $i<10; $i++){
            $this->balance();
            echo '~~~~平稳飞行======<br />';
        }
        echo '<<<<<<<<<<<<<<<<<<开始降落<<<<<<<<<<<<<<<<<<br />';
    }
}

$apache = new Fly();
$apache->start();

/*
 * 总结：
 * 1）类前加abstract是抽象类；方法前加abstract是抽象方法
 * 2）抽象类不能实现实例化；抽象方法不能有方法体
 * 3）有抽象方法必是抽象类；抽象类未必有抽象方法
 * 如果是抽象类，即便其内全部是具体方法，也不能实例化该类
 */
echo '<hr>';
abstract class Car{
    public function start(){
        echo '启动~~~~<br />';
    }
}

class Pub extends Car{
    
}

$gg = new Pub();
$gg->start();

/**
 * 抽象类的意义：
 * Facebook多国语言欢迎页面
 * user登陆，有一个c字段，表示其国家
 * 当各国人登陆时，看到各国语言欢迎界面
 * 
 * 我们可以用面向过程的来做
 * if ($c == 'china'){
 *     echo '你好，非死不可';
 * } else if ($c == 'english'){
 *     echo 'hi,facebook';
 * } else {
 *     echo '搜打死内';
 * }
 * 反思：当facebook进入泰国市场时，再增加新的else if，扩展性很差
 */

//用面向对象来做：
/*
 * 让美国小组，中国开发组，韩国开发组来开发Welcome类，争执不下，echo哪国的？
 * 说：干脆在wel()方法里再判断一下？
 */
/* class Welcome{
    public function wel(){
        echo '';
    }
    
    $wel = new Welcome();
    $wel->wel();
} */

//这是首页的controller开发者，说：
/*
 * 你们别争执了，我只知道，我要滴啊用wel方法，就是打招呼，你们显示什么语言和我无关
 */
//经理：Welcome谁也不允许动，各国开发小组各自开发自己的招呼类
//    另外，为了首页的controller开发者便于调用，统一继承自welcome类
abstract class Welcome{
    public abstract function wel();
}

class China extends Welcome{
    public function wel(){
        echo '你好，非死不可<br />';
    }
}

class English extends Welcome{
    public function wel(){
        echo 'hi,facebook<br />';
    }
}

class Japan extends Welcome{
    public function wel(){
        echo '搜打死内<br />';
    }
}

//再看首页调用者
$c = 'china';
$wel = new $c();
$wel->wel();

$c = 'english';
$wel1 = new $c();
$wel1->wel();

$c = 'japan';
$wel2 = new $c();
$wel2->wel();

/*
 * 以后如果新增了泰国语，首页的开发者，根本无需改动，只需要增加一个泰国的招呼类即可。
 * 所以有一些面向对象的介绍中，说面向对象的一个特点，可插拔特性
 */
?>