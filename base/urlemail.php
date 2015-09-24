<!-- 表单验证反馈结果 -->
<?php
$nameErr = $emailErr = $websiteErr = $genderErr = "";
$name = $email = $website = $comment =$gender = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])){
        $nameErr = "姓名必填!";
    }else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)){
            $nameErr = "姓名只能是字母或者空格";
        }
    }
    if (empty($_POST["email"])){
        $emailErr = "邮箱必填!";
    }else {
        $email = test_input($_POST["email"]);
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)){
            $emailErr = "邮箱格式不正确！";
        }
    }
    if (empty($_POST["website"])){
        $website = "";
    }else {
        $website = test_input($_POST["website"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%
=~_|]/i",$website)){
            $websiteErr = "无效的url";
        }
    }
    if (empty($_POST["comment"])){
        $comment = "";
    }else {
        $comment = test_input($_POST["comment"]);
    }
    if (empty($_POST["gender"])){
        $genderErr = "性别必填!";
    }else {
        $gender = test_input($_POST["gender"]);
    }
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
	姓名:
		<input type="text" name="name" value="<?php echo $name;?>">
		<span class="error">* <?php echo $nameErr;?> </span>
		<br><br>
	邮件:
        <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?> </span>
        <br><br> 
	网站:
        <input type="text" name="website" value="<?php echo $website;?>">
        <span class="error"><?php echo $websiteErr;?> </span>
        <br><br>
	<label>评论:
        <textarea name="comment" rows="5" clos="40"><?php echo $comment;?></textarea>
        <br><br>
	性别:
        <input type="radio" name="gender" value="man">男性 
		<input type="radio" name="gender" value="woman">女性
		<span class="error">* <?php echo $genderErr;?> </span>
		<br><br> 
		<input type="submit">
	</form>
</body>
</html>

<?php 
echo "<h2>您的输入：</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $gender;
echo "<br>";
echo $comment;
?>
