<?php
header("Content-Type:text/html;charset=utf-8");

/**
 * 类：是某一类事务的抽象，是某类对象的蓝图
 *    比如，女娲造人时，脑子中关于人的形象，就是人类class Human
 *    如果女娲决定造人时，同时形象又没有最终定稿，在她的脑子中有哪些
 *    支离破碎的形象呢？
 *    
 *    她可能会这么思考：
 *    动物：吃饭
 *    猴子：奔跑
 *    猴子：哭
 *    自己：思考
 *    小鸟：飞
 *    
 *    我造一种生物，命名为人，应该有如下功能：
 *    eat()
 *    run()
 *    cry()
 *    think()
 * 接口：是更抽象的类
 */
interface Animal{
    public function eat();
}

interface Monkey{
    public function run();
    public function cry();
}

interface Wisdom{
    public function think();
}

interface Bird{
    public function fly();
}
/*
 * 如上，我们把每个类中的这种实现功能拆出来
 * 分析：如有有一种新生物，实现了eat+run+cry+think，这种智慧生物
 * 可以叫做人。
 */
////////////////////////////////////////////////////////////
/*
 * Fatal error: Class Human contains 4 abstract methods 
 * and must therefore be declared abstract or implement the 
 * remaining methods (Animal::eat, Monkey::run, Monkey::cry, ...) 
 * in F:\web\www\php\senior\133.php on line 48
 * 竟然说我有4个抽象方法
 * 因为接口的方法本身就是抽象，不要有方法体，也不必加abstract
 * 
class Human implements Animal,Monkey,Wisdom{
    
}
 */

/////////////////////////////////////////////////////////////
/*
 * 类如果是一种事务/动物的抽象，那么接口则是事务/动物功能的抽象，即再把他们的功能各拆成小块，
 * 自由组合成新的物种
 */
class Human implements Animal,Monkey,Wisdom{
    public function eat(){
        echo 'eat<br />';
    }
    public function run(){
        echo 'run<br />';
    }
    public function cry() {
        echo 'cry<br />';
    }
    public function think() {
        echo 'think<br />';
    }
}

$li = new Human();
$li->think();
//////////////////////////////////////////////////////////////
/*
 * 根据接口造一个鸟人
 */
class Birdman implements Animal,Monkey,Wisdom, Bird{
    public function eat(){
        echo 'eat<br />';
    }
    public function run(){
        echo 'run<br />';
    }
    public function cry() {
        echo 'cry<br />';
    }
    public function think() {
        echo 'think<br />';
    }
    public function fly(){
        echo 'fly<br />';
    }
}
$birdli = new Birdman();
$birdli->fly();
?>