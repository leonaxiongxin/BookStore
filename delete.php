<?php
	include('./connect.php');
	session_start();//启用session
	$username = $_SESSION['username'];
	$Bid =$_GET['Bid'];
	$sql=("DELETE FROM order_info WHERE username='$username' AND book_id='$Bid'");
		
    try{
		$stmt=$db->prepare($sql,array(PDO::FETCH_ASSOC));
		$stmt->execute();
		echo '<script>';	
		echo 'alert("删除商品成功");';
		echo 'window.location.href="cart.php";';
		echo '</script>';
	}
	catch(PDOException $e){
	    echo $e->getMessage();
		echo '<script>';	
        echo 'alert("删除商品失败");';
		echo '</script>';	
	}
	
?>
