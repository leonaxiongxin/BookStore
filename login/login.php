
<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
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
           <li id="UserButton"><a href="home.php">
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
           <li id="SignInButton" class="active"><a href="login.php">Sign in</a></li>
           <li id="SignUpButton"><a href="signup.php">Sign up</a></li>
           <li id="SignUpButton"><a href="signout.php">Sign out</a></li>    
       </ul>
       </div>
       <div class="col-sm-5">
            
       </div>
       </div>
    </div>
</div>  

<div class="login-box">
	<div class="title">用户登录</div>
	<div  class="content">
	<form action="signin.php" method="POST" role="form">
	    <div>
		<label>用户昵称：</label>
			<input type="text" name="user_name" class="form-control" required>
	    </div>
		<div>
		<label>输入密码：</label>
			<input type="password" class="form-control" name="psd" required>
	    </div>
		<div>
		<button type="submit" name="submit" class="btn btn-block btn-primary">登录</button>
		</div>
	</form>
	<div style="text-align:center; padding-bottom:10px;"><a href="">Forget Password ?</a></div>
	</div>

</div>
</body>
</html>