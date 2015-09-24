<?php
/*
 * 常量
 * 文件包含
 * 报错级别
 */
header("Content-Type: text/html;charset=utf-8");

/************常量***************/
//声明一个常量，命名规则和变量一样，只不过习惯上全大写
define('PI', 3.14);
echo PI, '<br>';

//声明后值不能修改，也不能重新声明，也不能销毁
//声明常量后，请常量在页面的任意处都可以访问
function t(){
    echo PI, '<br>';
}
t();

//检测常量
if (defined('PI')){
    echo '常量已存在', '<br>';
} else {
    echo '常量不存在', '<br>';
}

//开发一般这样使用
if (!defined('HEI')){
    define('HEI', 8846);
}
if (!defined('HEI')){
    define('HEI', 8846);
} else {
    echo 'HEI已定义:', HEI, '<br>';
}

//动态常量名，用变量的值做常量的名字
$chang = 'HEI';
echo $chang, '~~~', constant($chang), '<br>';

/**************文件包含**************/
//文件包含的意义在于代码的重用
//我们可以把常量代码段写在一个文件里，当需要这些代码时，引入这个文件就可以了
//include:写几次则进入几次，如果引入的文件不存在，有警告，但是程序会尽量执行
//include_once:加后缀_once的作用->文件只引入一次，如果之前引用过，则不再此引入
//require:如果引入的文件不存在，则程序终止
//require_once:加后缀_once的作用->文件只引入一次，如果之前引用过，则不再此引入
//不加once的速度会快一些
echo '<br>';
include('06include.php');

/*include('06once.php');
include('06once.php');
include('06once.php');
include('06once.php');
hello();
echo '<br>';
echo $age, '<br>'; 结果等于5*/

/*
include_once('06once.php');
include_once('06once.php');
include_once('06once.php');
include_once('06once.php');
hello();
echo '<br>';
echo $age, '<br>';结果等于2*/

/*
include_once('06once.php');
include_once('06once.php');
include_once('06once.php');
include('06once1.php');
hello();
echo '<br>';
echo $age, '<br>';有警告，但是能运行出结果*/

/*
include_once('06once.php');
include_once('06once.php');
include_once('06once.php');
require('06once1.php');
hello();
echo '<br>';
echo $age, '<br>';有警告和错误，程序结束*/

//php脚本的错误，分多个等级，如致命错误，notice，warning等
//如何方便的设置报错级别？
//php把不同等级的级别，用数字类表示：
//1.E_ERROR（integer） 致命的运行错误，这类错误一般不可恢复的情况，
//  例如内存分配导致的问题，后果是导致脚本终止
//2.E_WARNING（integer） 运行时警告（非致命错误），仅给出提示信息，但是脚本不会终止运行。
//4 8 16等
//设置报告所有错误
error_reporting(E_ALL);
//不报任何错误
error_reporting(0);
//希望报所有错误，除了notice错误
error_reporting(E_ALL^E_NOTICE);
error_reporting(E_ALL&(~E_NOTICE));
?>