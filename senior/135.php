<?php
header("Content-Type:text/html;charset=utf-8");

/**
 * 类的自动加载
 */
/* require './135_HumanModel.php';

$li = new HumanModel();
$li->t(); */
//////////////////////////////////////////////////////////////
/*
 * 
 * 如下：没有require时，报错，需要手动require进来
 *
 * 如果网站比较大，model类比较多
 * HumanModel
 * UserModel
 * GoodsModel
 * OrderModel
 * ...
 * 1）这么多的model，我用谁都得include/require谁
 * 2）而且不知道，之前是否已经include/require金磊某个类（这个可用once可以解决，但once效率很低）
 *
 * 这时，我们可以用自动加载！
 */
/* function __autoload($c){
    echo $c,'<br />';
}

$ming = new Dog(); */
///////////////////////////////////////////////////////////////
/*
 * 如果调用某个不存在的类，在报错之前，我们还有一次介入机会，__autoload函数
 * 系统会调用__autoload()函数，并把“类名”自动传给__autoload函数
 * 我们自然可以在autoload里加载需要的类
 */
/* function __autoload($c){
    echo '我先自动加载  ./135_'.$c.'.php';
    require './135_'.$c.'.php';
}
$si = new HumanModel();
$si->t(); */
//////////////////////////////////////////////////
/* function test(){
    echo 'lai';
    class yan{
        public static function sing(){
            echo 'singing~~';
        }
    }
    echo 'qu';
}
test();
yan::sing(); */
//////////////////////////////////////////////////
/*
 * 自动加载只能用__autoload函数吗？
 * 答：不是的，其实也可以指定一个函数。比如我们就用zdjz
 * 
 * 注意：要通知系统，让系统知道我自己写了一个自动加载方法，用这个！怎么通知？
 * 用系统函数spl_autoload_register
 */

//下面这句话是把zdjz函数注册成“自动加载函数”
spl_autoload_register('zdjz');

function zdjz($c){
    echo './135_'.$c.'.php'.'<br />';
    require './135_'.$c.'.php';
}

$h = new HumanModel();
$h->t();
/*
 * __autoload是一个函数
 * 我能自己注册一个自动加载函数，能否注册类的一个静态方法，当自动加载函数？
 * TP就这这么做的，请自行解决。
 */
?>