<!-- ����֤������� -->
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
	<!-- ����֤ -->
	<h1>PHP����֤</h1>
	<p>*�����ֶ�</p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		����:<input type="text" name="name"><br> 
		�ʼ�:<input type="text" name="email"><br> 
		��վ:<input type="text" name="website"><br> 
		����:<textarea name="comment" rows="5" clos="40"></textarea><br> 
		�Ա�:<input type="radio" name="gender" value="man">���� 
		    <input type="radio" name="gender" value="woman">Ů��<br> 
		    <input type="submit">
	</form>
</body>
</html>
