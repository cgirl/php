<!-- ����֤������� -->
<?php
$nameErr = $emailErr = $websiteErr = $genderErr = "";
$name = $email = $website = $comment =$gender = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])){
        $nameErr = "��������!";
    }else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)){
            $nameErr = "����ֻ������ĸ���߿ո�";
        }
    }
    if (empty($_POST["email"])){
        $emailErr = "�������!";
    }else {
        $email = test_input($_POST["email"]);
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)){
            $emailErr = "�����ʽ����ȷ��";
        }
    }
    if (empty($_POST["website"])){
        $website = "";
    }else {
        $website = test_input($_POST["website"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%
=~_|]/i",$website)){
            $websiteErr = "��Ч��url";
        }
    }
    if (empty($_POST["comment"])){
        $comment = "";
    }else {
        $comment = test_input($_POST["comment"]);
    }
    if (empty($_POST["gender"])){
        $genderErr = "�Ա����!";
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
	<!-- ����֤ -->
	<h1>PHP����֤</h1>
	<p>*�����ֶ�</p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	����:
		<input type="text" name="name" value="<?php echo $name;?>">
		<span class="error">* <?php echo $nameErr;?> </span>
		<br><br>
	�ʼ�:
        <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?> </span>
        <br><br> 
	��վ:
        <input type="text" name="website" value="<?php echo $website;?>">
        <span class="error"><?php echo $websiteErr;?> </span>
        <br><br>
	<label>����:
        <textarea name="comment" rows="5" clos="40"><?php echo $comment;?></textarea>
        <br><br>
	�Ա�:
        <input type="radio" name="gender" value="man">���� 
		<input type="radio" name="gender" value="woman">Ů��
		<span class="error">* <?php echo $genderErr;?> </span>
		<br><br> 
		<input type="submit">
	</form>
</body>
</html>

<?php 
echo "<h2>�������룺</h2>";
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
