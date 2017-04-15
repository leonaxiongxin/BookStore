<?php
include('./connect.php');
session_start();//启用session
$username = $_SESSION['username'];
if(!isset($_SESSION['username'])){
    echo '<script>';
    echo 'window.location.href="./login/login.php";';
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
   <link rel="stylesheet" type="text/css" href="css/cart.css">
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
           <li id="SignUpButton"><a href="login/signout.php">Sign out</a></li>    
       </ul>
       </div>
       <div class="col-sm-5">
            
       </div>
       </div>
    </div>
</div>  

<div class="main_car">
    <div class="title">购物车</div>
    <table >
        <tr class="table_head">
            <td width="300">商品名</td>
            <td width="150">单价（元）</td>
            <td width="90">数量</td> 
            <td width="150">金额（元）</td>
            <td width="177">操作</a></td>
        </tr>

        <?php
			include('./connect.php');
			$sum = 0;
			$row_count = 0;
			$sql = "SELECT * FROM order_info WHERE username='$username'";
			$stmt = $db->prepare($sql,array(PDO::FETCH_ASSOC));
			$stmt ->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {		  
				  $row_count = $row_count + 1;
				  $Bid = $row['book_id'];
        ?>

        <?php
		    
            include('./connect.php');
            $query = "SELECT * FROM book WHERE ISBN='$Bid'";
            $sth = $db->prepare($query,array(PDO::FETCH_ASSOC));
            $sth ->execute();
            $row1 = $sth->fetch(PDO::FETCH_ASSOC);
            $sum += $row1["bprice"]*$row["num"]; 
        ?>
        <tr>
            <td width="300"><?php echo $row1['bname'];?></td>
            <td width="150"><?php echo '￥'.$row1['bprice'];?></td>
            <td width="90"><?php echo $row['num'];?></td>
            <td width="150"><?php echo '￥'.$row1['bprice']*$row['num'];?></td> 
            <td width="177"><button class="btn" 
			   onclick=" 
			       if(window.confirm('您确定要删除该商品吗？')){
                        window.location.href='delete.php? Bid=<?php echo $row["book_id"]?>';
                    } 
					else {
                        alert('已取消删除商品');
                    }">删除</button></td>
        </tr>
   
        <?php
          }
        ?>
        <tr class="table_head count" >
            <td colspan="5"><div style="margin-right: 30px; float: right;"><?php echo "总价格:".$sum;?></div></td>
        </tr>
    </table>
        
    <div class="btn_box">
        <button class="btn "><a href="main.php">返回继续购物</a></button>
        <button class="btn" id="buy_now">立即购买</button>
    </div>
</div>

      <script type="text/javascript">
            var btn_buy = document.getElementById('buy_now');
            btn_buy.onclick = function(){
                
                if (window.confirm("您确定要购买吗？")) {
                  window.location.href="checkBuy.php";
                } else {
                  alert("已取消购买");
                }
            }
           
      </script>

</body>
</html>