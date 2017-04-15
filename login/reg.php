<?php
    $user_name = htmlspecialchars($_POST["username"]);
	$e_mail = htmlspecialchars($_POST["email"]);
	$psd = htmlspecialchars($_POST["password"]);
	$psd_a = htmlspecialchars($_POST["repassword"]);
	$tel = htmlspecialchars($_POST["mobile"]);
	$bir = htmlspecialchars($_POST["birthday"]);

	//注册信息判断
  	if (!preg_match("/[a-za-z0-9]+@[a-za-z0-9]+.com/",$e_mail))  
  		{  
      		exit('错误：E-mail已经被使用或者格式错误！<a href="javascript:history.back(-1);">返回</a>');
  		}
	 
	if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z]).{6,16}$/",$psd))  
	  {  
	      exit('错误：密码应为6~16位大小写英文字母！<a href="javascript:history.back(-1);">返回</a>');
	  }  

	if ($psd != "" && $psd_a !="")
		{
			if ($psd != $psd_a) {
				exit('错误：密码再次输入错误！<a href="javascript:history.back(-1);">返回</a>');
		}
	}

	if(!preg_match("/^[0-9]{11}$/", $tel)){
			exit('错误：电话号码格式错误！<a href="javascript:history.back(-1);">返回</a>');
		}
	
	$tempbir = '#(19|20)(\d){2}/(0[1-9]|1[0-2])/(0[1-9]|[12][0-9]|3[0-1])#';
	if (!preg_match($tempbir,$bir))  
	 {  
	     exit('错误：生日格式不合法！<a href="javascript:history.back(-1);">返回</a>');
	 }  

	//包含数据库连接文件
	include('../connect.php');
	//检测用户昵称是否已经存在
	$sql="select username from user where username='$user_name' limit 1";
	$stmt = $db->prepare($sql,array(PDO::FETCH_ASSOC));
    $stmt ->execute();   
    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       echo '错误：用户昵称 ',$user_name,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
       exit;
	}
	//检测注册邮箱是否已经存在
	$sql="select email from user where email='$e_mail' limit 1";
	$stmt = $db->prepare($sql,array(PDO::FETCH_ASSOC));
    $stmt ->execute();   
    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '错误：电子邮箱 ',$e_mail,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
        exit;
	}
	
    else{
	  //写入数据
	  try{
		$password = MD5($psd);
		$sql = "INSERT INTO user(username,email,password,birthday,mobile)VALUES('$user_name','$e_mail','$password','$bir','$tel')";
		$insert_sql = $db->prepare($sql,array(PDO::FETCH_ASSOC));
		$insert_sql->execute();
		echo '用户注册成功！点击此处 <a href="login.php">登录</a>';
	  } 
	  catch(PDOException $e) {
	    echo '抱歉！添加数据失败';
	    echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
	  }
	  
	}

?>