<?php
/*
 * 浮点数不精确
 * 
 */
header("Content-Type: text/html;charset=utf-8");

/* 因为某些小数在10进制下，是有限的，但是转成2进制要无限循环，因此，会损失一些精度，导致浮点数计算
 * 和数学上结果不一致，银行一般都存整数，精确到分 */
if((0.3-0.2) == 0.1){
    echo 0.3-0.2,' 相等';
} else {
    echo 0.3-0.2, ' 不相等';
}
?>

<?php 
$path = '.';
$url = $_SERVER['REQUEST_URI'];

if (isset($_GET['dir'])){
    $path = $path.'/'.$_GET['dir'];
} else {
    $url = $url.'?dir=';
}

$dh = opendir($path);
if ($dh === false){
    echo '打开出错';
    exit;
}

while(($item = readdir($dh)) !== false){
    $list[] = $item;
}

print_r($list);
closedir($dh);

?>
<!--  文件管理系统练习  -->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-sacle=1.0">
<title>文件管理系统</title>
<style type="text/css">
    td{
    	border:1px solid gray;
    }
</style>
</head>
<body>
	<h4>文件管理系统</h4>
	<table>
	   <tr>
	       <td>序号</td>
	       <td>文件名</td>
	       <td>操作</td>
	   </tr>
	   <?php 
	       foreach ($list as $k=>$v){
	   ?>
	   <tr>
	       <td><?php echo $k ?></td>
	       <td><?php echo $v ?></td>
	       <td>
	       <?php 
	           if (is_dir($path.'/'.$v)){
	               echo '<a href="',$url.$v,'/">浏览</a>';
	           } else {
	               echo '<a href="', $_GET[dir].$v, '">查看</a>';;
	           }
	       ?>
	       </td>
	   </tr>
	   <?php }?>
	</table>
</body>
</html>