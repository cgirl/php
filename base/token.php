<!-- 表单验证反馈结果 -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo test_input($_POST["name"]);
    echo test_input($_POST["email"]);
    echo test_input($_POST["website"]);
    echo test_input($_POST["comment"]);
    echo test_input($_POST["gender"]);
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html>
<body>
	<!-- 表单验证 -->
	<h1>PHP表单验证</h1>
	<p>*必填字段</p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		姓名:<input type="text" name="name"><br> 
		邮件:<input type="text" name="email"><br> 
		网站:<input type="text" name="website"><br> 
		评论:<textarea name="comment" rows="5" clos="40"></textarea><br> 
		性别:<input type="radio" name="gender" value="man">男性 
		    <input type="radio" name="gender" value="woman">女性<br> 
		    <input type="submit">
	</form>
</body>
</html>
