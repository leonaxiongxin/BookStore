
<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="styleheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="global-nav">
    <div class="container">
       <div class="row">
       <div class="col-sm-7">
       <ul class="nav nav-tabs">
           <li><a href="../main.php">Home</a></li>
           <li id="UserButton"><a href="../home.php">
              <span class="glyphicon glyphicon-user">个人中心
                  <?php if(isset($_SESSION)) 
                      $username = $_SESSION['username'];
                      echo $username;
                  ?>
              </span></a>
           </li>
           <?php $_SESSION['username']=$username; ?> 
           <li id="CartButton"><a href="../cart.php">
               <span class="glyphicon glyphicon-shopping-cart">购物车</span></a>
            </li>
           <li id="SignInButton"><a href="signin.html">Sign in</a></li>
           <li id="SignUpButton"  class="active"><a href="login.php">Sign up</a></li>
           <li id="SignUpButton"><a href="signout.php">Sign out</a></li>    
       </ul>
       </div>
       <div class="col-sm-6">
            
       </div>
       </div>
    </div>
</div>  

<div class="login-box">
	<div class="title">用户注册</div>
	<div class="content">
	<form action="reg.php" method="POST" role="form" id="form" name="RegForm" onSubmit="return InputCheck(this)">
	    <div>
			<label>用户昵称：</label>
			<input type="text" name="username" class="form-control" required>
			<span class="remindbox">请输入用户昵称作为你的账号</span>
		</div>
		<div>
			<label>电子邮箱：</label>
			<input type="email" name="email" class="form-control"  required>
			<span class="remindbox">请输入常用的电子邮箱作为验证</span>
		</div>
		<div>
			<label>设置密码：</label>
			<input type="password" class="form-control" name="password" required>
			<span class="remindbox">请输入8~16位密码，必须含有大小写英文字母</span>
		</div>
		<div>
			<label>确认密码：</label>
			<input type="password" class="form-control" name="repassword" required>
			<span class="remindbox">请再次输入确认密码</span>
		</div>
		<div>
			<label>手机号码：</label>
			<input type="text" name="mobile" class="form-control"  required>
			<span class="remindbox">请输入中国地区手机号码</span>
		</div>
		<div>
			<label>出生日期：</label>
			<input type="text" name="birthday" class="form-control" placeholder="YYYY/MM/DD" required>
			<span class="remindbox">请输入您的生日</span>
		</div>
		<div>
		    <button type="submit" class="btn btn-block">注册</button>
		</div>
	</form>
	</div>
</div>

<script type="text/javascript">
	window.onload = function () {
	    var form = document.getElementById('form');
	    var boxs = form.children;

	    for (var i = 0; i < boxs.length-1; i++) {
		    var remind = boxs[i].getElementsByTagName('input')[0];
			remind.onfocus = function () {
		        this.parentNode.getElementsByClassName('remindbox')[0].style.display="inline-block"; 
		    }
		    remind.onblur = function(){
		    	this.parentNode.getElementsByClassName('remindbox')[0].style.display="none";
		    }
	    }
    }
    function InputCheck(RegForm)
		{
		  if (RegForm.username.value == "")
		  {
		    alert("用户昵称不可为空!");
		    RegForm.username.focus();
		    return (false);
		  }
		  if (RegForm.email.value == "")
		  {
		    alert("电子邮箱不可为空!");
		    RegForm.email.focus();
		    return (false);
		  }
		  if (RegForm.password.value == "")
		  {
		    alert("必须设定登录密码!");
		    RegForm.password.focus();
		    return (false);
		  }
		  if (RegForm.repassword.value != RegForm.password.value)
		  {
		    alert("两次密码不一致!");
		    RegForm.repassword.focus();
		    return (false);
		  }
		  if (RegForm.tel.value == "")
		  {
		    alert("手机号码不能为空!");
		    RegForm.tel.focus();
		    return (false);
		  }
		  if (RegForm.birthday.value == "")
		  {
		    alert("生日不能为空!");
		    RegForm.birthday.focus();
		    return (false);
		  }

		}
	</script>
</body>
</html>