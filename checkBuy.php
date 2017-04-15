<?php
    include('connect.php');
    session_start();//启用session
    $username = $_SESSION['username'];
    if(!isset($_SESSION['username'])){
        echo '<script>';
        echo 'window.location.href="./login/login.html";';
        echo '</script>';
    }
    else
       $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
   <title>Online Book Store</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="css/main.css">
   <link rel="stylesheet" type="text/css" href="css/buy.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="styleheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>


<body>
<div class="global-nav">
    <div class="container">
       <div class="row">
       <div class="col-sm-7">
       <ul class="nav nav-tabs">
           <li><a href="main.php">Home</a></li>
           <li id="UserButton"><a href="home.php">
              <span class="glyphicon glyphicon-user">个人中心
                  <?php if(isset($_SESSION)) 
                      $username = $_SESSION['username'];
                      echo $username;
                  ?>
              </span></a>
           </li>
           <?php $_SESSION['username']=$username; ?> 
           <li id="CartButton"  class="active"><a href="cart.php">
               <span class="glyphicon glyphicon-shopping-cart">购物车</span></a>
            </li>
           <li id="SignInButton"><a href="login/signin.html">Sign in</a></li>
           <li id="SignUpButton"><a href="login/signup.php">Sign up</a></li>
           <li id="SignUpButton"><a href="login/signout.php">Sign out</a></li>    
       </ul>
       </div>
       <div class="col-sm-5">
            
       </div>
       </div>
    </div>
</div>  

</div>
   	<div class="remind-box">
          <div class="clear">
            <img src="image/对勾.png" alt="图标" class="icon">
            <div class="remind-txt">商品购买成功！</div>
          </div>
        </div>
 
</body>
</html>
