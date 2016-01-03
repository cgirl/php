<?php
header("Content-Type:text/html;charset=utf-8");

/**
 * 接口具体语法：
 * 1）以人类为例，class Human是人的草图，而接口时零件，可以用个多钟零件组合出一种新特种来
 * 2）如上：接口本身是抽象的，内部声明的方法默认也是抽象的，不用加abstract
 * 3）一个类可以一次性实现多个接口，语法用 interface 实现（把我这几个功能实现了）
 *   class ClassName inplements interface1,interface2,interface3{
 *   }
 *   然后再把接口的功能实现了
 * 4）接口也可以继承，用extends
 * 5）接口时一堆方法的说明，不能加属性
 * 6）接口就是共类组装成类用的，方法只能是public
 */
interface Animal{
    public function eat();
}

interface Monkey extends Animal{
    public function run();
    public function cry();
}

interface Wisdom{
    public function think();
}

interface Bird extends Animal{
    public function fly();
}

//下面有误，monkey继承的animal接口，因此必须要把eat实现
/* class Human implements Monkey,Wisdom{
    public function run(){
        echo 'run<br />';
    }
    public function cry() {
        echo 'cry<br />';
    }
    public function think() {
        echo 'think<br />';
    }
} */

class Human implements Monkey,Wisdom{
    public function run(){
        echo 'run<br />';
    }
    public function cry() {
        echo 'cry<br />';
    }
    public function think() {
        echo 'think<br />';
    }
    public function eat(){
        echo 'eat<br />';
    }
}
///////////////////////////////////////////////////////////////
/**
 * 应用场景
 * 面向对象：
 * 1）做的越多，越容易犯错
 * 
 * 抽象类（就定义类模板） -- 具体子类实现（china,japan,english）
 * 接口：
 */
//抽象的数据库类
/*
 * 创业前期，做网站
 * 到底用什么数据库？mysql,oracle,sqlserver,postgresql?
 * 这样，先开发网站，运行再说
 * 先弄个mysql开发者，正式上线再换数据库也不迟
 * 
 * 引来问题：
 * 换数据库，会不会以前的代码又得重写？
 * 答：不必，用抽象类。开发时必须以db抽象类来开发
 */
abstract class db{
    public abstract function conn($h, $u, $p);
    public abstract function query($sql);
    public abstract function close();
}
/*
 * 下面代码有误，因为子类实现时，conn和抽象类的conn的参数不一致
 
class mysql extends db{
    public function conn($h, $u){
        return true;
    }
    
    public function query($sql, $conn){
        return false;
    }
    
    public function close(){
        ;
    }
}

*/

//下面这个mysql类，严格实现了db抽象类。试想，不管上线时用什么数据库，我只需要写再写一份如下类：
//class oracle extends db{...}
//class nosql extends db{...}
//class sqlserver extends db{...}
//为什么不用改？因为都实现的db抽象类，我开发时，调用方法不清楚的地方，我就可以参考db抽象类
//反正子类都是严格实现抽象类的
class mysql extends db{
    public function conn($h, $u, $p){
        return true;
    }

    public function query($sql){
        return false;
    }

    public function close(){
        ;
    }
}
/*
 * 接口就更加抽象了，比如一个社交网站，关于用户的处理是核心应用：
 * 登陆
 * 退出
 * 写信
 * 看信
 * 招呼
 * 更换心情
 * 撩骚
 * 示爱
 * 
 * 这么多的方法，都是用户的方法，自然可以写一个user类，全包装起来
 * 但是，分析用户往往一次性用不了这么多方法。
 * 用户信息类：{登陆，写信，看信，招呼，更换心情，退出}
 * 用户活动类：{登陆，示爱，撩骚，退出}
 * 
 * 开发网站钱分析出来这么多方法，但是不能都装在一个类里，分成了2个类，甚至更多
 * 作为应用逻辑的开发者，这么多的类，这么多的方法，都晕了
 */
interface UserBase{
    public function login($u, $p);
    public function logout();
}

interface UserMsg{
    public function writeMsg($to, $title, $content);
    public function readMsg($from, $title);
}

interface UserFunny{
    public function spit($to);
    public function showLove($to);
}
/*
 * 作为调用者，我不需要了解你的用户信息类，用户娱乐类，我就可以知道如何调用这两个类了
 * 因为这两个类，都要事先上述接口，通过这个接口，就可以规范开发
 */
/*
 *下面这个类和接口声明的参数不一样，就报错，这样，接口强制统一了接口
 
class User implements UserBase{
    public function login($u) {
        ;
    }
}

*/
?>