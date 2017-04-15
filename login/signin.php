<?php
session_start();

$user_name =$_POST["user_name"];
$psd = MD5($_POST["psd"]);

/* include the connect file */
include('../connect.php');

//检测用户名及密码是否正确
$sql = "select username from user where username='$user_name' and password='$psd'";
$check_sql = $db->prepare($sql, array(PDO::FETCH_ASSOC));
$check_sql->execute();

if($check = $check_sql->fetch(PDO::FETCH_ASSOC)){
	/* 登入成功導向主要頁面 */
	$_SESSION['username'] = $check['username'];
	echo '<script>';
	echo 'window.location.href="../home.php";';
	echo '</script>';
}
else{
	/* 帳密有錯導回登入頁面 */
	echo '<script>';
	echo 'alert("帳號密碼有誤");';
	//echo 'window.history.back();';
	echo '</script>';
	
}
?>

