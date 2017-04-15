<?php
    session_start();
    include('./connect.php');

    if(!isset($_SESSION['username'])){
        echo '<script>';
        echo 'window.location.href="login/login.php";';
        echo '</script>';
    }
    else{
        $username = $_SESSION['username'];
    }
?>

<!DOCTYPE html>
<head>
    <title>Online Book Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="styleheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>
<div class="global-nav">
    <div class="container">
       <div class="row">
       <div class="col-sm-7">
       <ul class="nav nav-tabs">
           <li><a href="main.php">Home</a></li>
           <li id="UserButton"  class="active"><a href="home.php">
              <span class="glyphicon glyphicon-user">个人中心
                  <?php
				  if(isset($_SESSION)) 
                      $username = $_SESSION['username'];
                      echo $username;
                  ?>
              </span></a>
           </li>
           <?php $_SESSION['username']=$username; ?> 
           <li id="CartButton"><a href="cart.php">
               <span class="glyphicon glyphicon-shopping-cart">购物车</span></a>
            </li>
           <li id="SignInButton"><a href="login/login.php">Sign in</a></li>
           <li id="SignUpButton"><a href="login/signup.php">Sign up</a></li>
           <li id="SignUpButton"><a href="login/signout.php">Sign out</a></li>    
       </ul>
       </div>
       <div class="col-sm-5">
            
       </div>
       </div>
    </div>
</div>  


    <div class="home">
        <p class="slogan">我們的精神角落</p>
            <?php
                $sql = "SELECT * FROM user WHERE username='$username' ";
                $info_sql = $db->prepare($sql, array(PDO::FETCH_ASSOC));
                $info_sql->execute();
                $result = $info_sql->fetch(PDO::FETCH_ASSOC);
                $_SESSION['username']=$result['username'];
                $useremail = $result['email'];
                $userfirstname = $result['firstname'];
                $userlastname = $result['lastname'];
                $usergender = $result['gender'];
                $useraddress = $result['address'];
                $usermobile = $result['mobile'];
                $userbday = $result['birthday'];
            ?>
        <div class="form-group">
            <form action="edit.php" method="POST" role="form">
            <legend>Edit My Info</legend>
			</div>
			<div class="row">
				<div class="col-sm-1">用户昵称</div>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="username" name="username" placeholder="Input field" value="<?php echo $username; ?>" disabled>
                </div>
			</div>
			<div class="row">
				<div class="col-sm-1">真实姓</div>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="userlastname" name="userlastname" placeholder="Input field" value="<?php echo $userlastname; ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1">真实名</div>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="userfirstname" name="userfirstname" placeholder="Input field" value="<?php echo $userfirstname; ?>">
                </div>
			</div>
			<div class="row">
				<div class="col-sm-1">电子邮箱</div>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="useremail" name="useremail" placeholder="Input field" value="<?php echo $useremail; ?>" disabled>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1">出生日期</div>		
                <div class="col-sm-5">
					<input type="text" class="form-control" id="userbday" name="userbday" placeholder="Input field" value="<?php echo $userbday; ?>" disabled>
                </div>
			</div>
			<div class="row">
				<div class="col-sm-1">移动电话</div>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="usermobile" name="usermobile" placeholder="Input field" value="<?php echo $usermobile; ?>" disabled>
				</div>  
            </div>
			<div class="row">				
                <div class="col-sm-1">性别</div>
				<div class="col-sm-5">
                    <div class=" radio radio-inline">
					     <label><input type="radio" name="usergender" id="usergender" value="M" <?php if($usergender == 'M'){echo 'checked="checked"';} ?> >男</label>
						 <label><input type="radio" name="usergender" id="usergender" value="女" <?php if($usergender == '女'){echo 'checked="checked"';} ?> >女</label>
				   </div>
		        </div>
			</div>
			<div class="row">
                <div class="col-sm-1">收货地址</div>	
				<div class="col-sm-10">
					<input type="text" class="form-control" id="useraddress" name="useraddress" placeholder="Input field" value="<?php echo $useraddress; ?>" required="required">
                </div>
			</div>
				
				<div class="col-sm-2">
                     <button type="submit" class="btn btn-primary">修改资料</button>
			    </div>
				<div class="col-sm-2">
                     <a class="btn btn-warning" href="login/signout.php" role="button">退出登录</a>
			    </div>
				<div class="col-sm-2">
                     <a class="btn btn-success" href="main.php" role="button">去補充精神食糧吧！</a>
			    </div>
		   
			 </form>
	    </div>

     </div>

</body>
</html>