<?php
include('./connect.php');
/* catch the post value from sign up form */
session_start();
if(!isset($_SESSION['username'])){
    echo '<script>';
    echo 'window.location.href="./login/signin.html";';
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
           <li id="CartButton" class="active"><a href="cart.php">
               <span class="glyphicon glyphicon-shopping-cart">购物车</span></a>
            </li>
           <li id="SignInButton"><a href="login/login.php">Sign in</a></li>
           <li id="SignUpButton"><a href="login/signup.php">Sign up</a></li>    
       </ul>
       </div>
       <div class="col-sm-5">
            
       </div>
       </div>
    </div>
</div>  

  
<?php
      include('./connect.php');
      $username = $_SESSION['username'];
      $Bid=$_GET["Bid"];//得到购买物品的id
      $num = 1;
      $Order = md5(uniqid(rand()));

      add_item($Order, $Bid, $username, $num);

      function check_item($username,$Bid) {
		  include('./connect.php');        //!important
          $query = "select * from order_info where username='$username' and book_id='$Bid' " ;
		  $result=$db->query($query);
          $stmt = $db->prepare($query,array(PDO::FETCH_ASSOC));
		  $stmt->execute(); 
          $row = $stmt->fetch(PDO::FETCH_ASSOC); 
          $numRows = $result->columnCount();		  
          if(!$row) {
             return 0;
          }
          if( $numRows == 0) {
             return 0;
          } 
          else {
              return $numRows;
          }
       }

      function add_item($Order, $Bid, $username, $num) {
		  include('./connect.php');         //!important
          $quantity = check_item($username, $Bid);
          /*先检查该类物品有没有已经放入车中*/
          /*若车中没有，则像车中添加该物品*/
          if( $quantity == 0) {
               $query = "INSERT INTO order_info (order_id, username,book_id,num) VALUES('$Order', '$username', '$Bid', '$num') ";
               include('./connect.php');         //!important
               try{
				  $insert_sql = $db->prepare($query,array(PDO::FETCH_ASSOC));
		          $insert_sql->execute();
                  echo '
                      <div class="remind-box">
                      <div class="clear">
                           <img src="image/对勾.png" alt="图标" class="icon img-responsive">
                           <div class="remind-txt">商品已成功添加至购物车！</div>
                      </div>
                      <div class="link_box">
                           <span class="link_cart"><a href="cart.php">查看购物车</a></span>
                           <span class="link_main"><a href="main.php">返回继续购物</a></span>
                      </div>
                      </div>
                     ';
               } 
               catch(PDOException $e) {
				  echo $e->getMessage();
                  echo '
                      <div class="remind-box">
                          <img src="image/打叉.png" alt="图标"class="icon">
                          <div class="remind-txt">抱歉！添加数据失败</div>
                          <div class="link_box">
                               <div class="link_d"><a href="main.php">请返回重试</a></div>
                          </div>
                      </div>
                    ';   
              }
          }
          //若有，则在原有基础上增加数量
          else{
             $num += $quantity; 
             $query = "UPDATE order_info SET num='$num' WHERE username='$username' AND book_id='$Bid'" ;
             include('./connect.php');
             try{
				  $insert_sql = $db->prepare($query,array(PDO::FETCH_ASSOC));
		          $insert_sql->execute();
                  echo '
                      <div class="remind-box">
                          <div class="clear">
                               <img src="image/对勾.png" alt="图标" class="icon">
                               <div class="remind-txt">商品已成功添加至购物车！</div>
                          </div>
                          <div class="link_box">
                              <div class="link_d"><a href="cart.php">查看购物车</a></div>
                              <div class="link_d"><a href="main.php">返回继续购物</a></div>
                          </div>
                      </div>
                    ';
             }
             catch(PDOException $e){
				  echo $e->getMessage();
                  echo '
                     <div class="remind-box">
                         <img src="image/打叉.png" alt="图标"class="icon">
                         <div class="remind-txt">抱歉！添加数据失败</div>
                         <div class="link_box">
                             <div class="link_d"><a href="main.php">请返回重试</a></div>
                         </div>
                     </div>
                    ';   
                  }
             }
        }
?>  
</body>
</html>
