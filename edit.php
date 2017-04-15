<?php
	session_start();
	/* include the connect file */
	include('./connect.php');

	$username = $_SESSION['username'];
	$firstname = $_POST['userfirstname'];
	$lastname = $_POST['userlastname'];
	$gender = $_POST['usergender'];
	$address = $_POST['useraddress'];

	/* 更新個人資料 */
	try{
		$sql = "UPDATE user SET firstname='$firstname',  lastname='$lastname', gender='$gender', address='$address' WHERE username='$username'";
		$edit_sql = $db->prepare($sql, array(PDO::FETCH_ASSOC));
		$edit_sql->execute();
		$_SESSION['username'] = $username;
		echo '<script>';
		echo 'alert("修改成功");';
		echo 'window.location.href="home.php";';
		echo '</script>';
	}
	catch(PDOException $e){
		/* 修改有誤告知使用者後導回 */
		echo $e->getMessage();
		echo '<script>';
		echo 'alert("修改失敗");';
		echo '</script>';
	}

?>