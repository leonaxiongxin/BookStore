<?php
   include('./connect.php');
   session_start();    //启用session
   if(!isset($_SESSION)){
	    $username='';
   }
   if(!isset($_SESSION)){
        $username = $_SESSION['username'];
   }
    empty($_GET['search']) && $_GET['search']=null;
    empty($_GET['page']) && $_GET['page']='1';
?>

<!DOCTYPE html>
<html>
<head>
   <title>Online Book Store</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="css/main.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="styleheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <style>
       .book_pic{
            height:180px;
            width:140px;
     }
   </style>
</head>

<body>
<div class="global-nav">
    <div class="container">
       <div class="row">
       <div class="col-sm-7">
       <ul class="nav nav-tabs">
           <li class="active"><a href="main.php">Home</a></li>
           <li id="UserButton"><a href="home.php">
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



<div class="wrap-nav" >
    <form action="main.php" method="GET" role="form" class="search"> 
          <div class="input-group">
          <input class="form-control" type="text" name="search" id="search" placeholder="书名" value="<?php echo $_GET['search'];?>">
              <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Go!</button>
              </span>
          </div>
    </form>
    <div class="menu">
        <ul class="nav nav-pills">
            <li><a class="active" href="#literature">文学</a></li>
            <li><a href="#technology">科技</a>
            <li><a href="#finance">经管</a></li>
            <li><a href="#life">生活</a></li> 
            <li><a href="#culture">文化</a></li> 
            <li><a href="#">2016年度榜单</a></li> 
            <li><a href="#">2016读书报告</a></li>
            <li><a href="#more">更多»</a></li>
        </ul>   
    </div>
</div>
  
     
<div class="wrapper">
    <div class="carousel-inner" class="first">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
       <div class="carousel-inner" role="listbox">
           <div class="item active" class="first">
               <div class="div1"><img src="image/1.jpg" alt="Chania" width="100%" height="200"></div>
           </div>
           <div class="item">
               <div class="div1"><img src="image/2.jpg" alt="Chania" width="100%" height="200"></div>
           </div>
           <div class="item">
               <div class="div1"><img src="image/3.jpg" alt="Chania" width="100%" height="200"></div>
           </div>
           <div class="item">
               <div class="div1"><img src="image/4.jpg" alt="Chania" width="100%" height="200"></div>
           </div>
       </div>
       <!-- Left and right controls -->
       <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
       </a>
       <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
       </a>
    </div>
    </div>
</div>

<div class="content">
   <div class="row">
   <div class="book-express col-sm-8">
      <div class="row hd">
          <div class="col-sm-3 ">
                <span class="heading">新书速递</span>
                <span class="link-more"><a href="#">更多»</a></span>
          </div>
          <div class="col-sm-9">
          <div class="row slide-controls">
             <div class="col-sm-7">
             </div> 
             <div class="col-sm-4">
                <ol class="slide-dots">
                   <li><a href="main.php? page=1" class="active" id="page1"></a></li>
                   <li><a href="main.php? page=2" class id="page2"></a></li>
                   <li><a href="main.php? page=3" class id="page3"></a></li> 
                   <li><a href="main.php? page=4" class id="page4"></a></li>
                </ol> 
                <span class="side-btns">
                   <a a href="main.php? page=<?php echo $_GET["page"]-1;?>" id="prev">‹‹</a>
                   <a a href="main.php? page=<?php echo $_GET["page"]+1;?>" id="next">››</a>
                </span>
             </div>
         </div>
         </div>
     </div>
  
      <?php
         $key=$_GET["search"]; 
         if ($key != null) {
             $sql="SELECT * FROM book WHERE bname LIKE '%$key%'";
		 }
		 else{	 
            $sql="SELECT * FROM book";
            $query=$db->query($sql);   
            $num =$query->columnCount();   //总条数
            $pagesize=8;        //设置每页显示8个记录 
			$page_num=4;         //设置共有4页
			$page=$_GET["page"]; //当前页数
			$page=(int)$page;
			$limit_page=($page-1)*$pagesize;
			$sql="SELECT * FROM book LIMIT $limit_page,$pagesize ";   //参数之前要有逗号分隔TAT
		 }
         $stmt = $db->prepare($sql,array(PDO::FETCH_ASSOC));
         $stmt ->execute();   
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     ?>

       
      <div class="bd" style="float:left;margin:0 25px 15px 0;">
          <?php 
              $image = $row['bimage'];
               echo "<div><img class='book_pic' src='".$image."'  alt='book'  ></div>";
          ?>
          <div><?php echo $row['bname'];?></div>
          <div><?php echo '￥'.$row['bprice'];?></div> 
          <button type="submit">
              <a href="buy.php? Bid=<?php echo $row["ISBN"]; ?>"  >加入购物车</a>
          </button>
      </div>

      <?php
          }  
      ?>

  </div>
  
  <div class="book-top col-sm-4">
       <div class="row">
          <div class="col-sm-11 col-sm-offset-1"> 
			  <div class="hd">	   
				  <span class="heading">受欢迎图书排行榜</span>
				  <span class="link-more"><a href="#">更多»</a></span>
			  </div>
		  
		  <?php   
             include('./connect.php');
			 $query ="SELECT book.bname,book.bauthor  FROM book,order_info WHERE book.ISBN=order_info.book_id ORDER BY order_info.num DESC LIMIT 15";
		     $check = $db->prepare($query,array(PDO::FETCH_ASSOC));
			 $check ->execute();
			 while($result = $check->fetch(PDO::FETCH_ASSOC)){
		 ?>
		   
		   <div class="row bd">
               <div class="col-sm-7 bname"><?php echo $result['bname'];?></div>
               <div class="col-sm-5 bauthor" ><?php echo $result['bauthor'];?></div> 
           </div>
	 <?php
		  }		   
       ?>

      </div>
	  
	  
  </div>


</div>
</div>


 
   

</body>
</html>