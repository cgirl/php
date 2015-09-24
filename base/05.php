<?php
/*
 * 其他基础重点笔记
 * 1.超级全局变量
 *   $_GET 地址栏上获得的值
 *   $_POST post表单发送的数据
 *   $_REQUEST 既有GET也有POST的内容
 *   
 *   $_ENV 服务器操作系统的环境变量，如操作系统类型，linux,win,mac等环境变量信息;
 *         容易暴露服务器信息，一般不允许显示，可以在配置文件中剔除E配置
 *   $_SERVER 操作系统下某个server的环境变量信息，如nginx,apache;
 *            可以获取当前网站的域名，一级当前访问的脚本，客户的ip（REMOTE_ADDR，HTTP_X_FORWARD_FOR）
 * 
 */
header("Content-Type: text/html;charset=utf-8");

//超全局变量
print_r($_GET);
echo '<br>';
print_r($_POST);
echo '<br>';
print_r($_REQUEST);
echo '<br>';

echo '<br>';
print_r($_ENV);
print_r($_SERVER);
echo '<br>';

//$GLOBALS是对全局变量花名册的一个别名，通过该变量，可以任意访问全局变量
echo '<br>';
$a = 4;
$b = 3;
function t(){
    print_r($GLOBALS);
    $GLOBALS['a'] = 99;
}
t();
echo '<br>';
echo $a;
echo '<br>';

?>
