<?php

if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
{
	// Get User Details //
	$sql_query1=mysqli_query($conn,"select * from products where user_id='".$_SESSION['session_web']['login_userId']."' order by product_id desc");
	$result_rows=mysqli_num_rows($sql_query1);
	if($result_rows==0)
	{
		$json = array("status" => 0, "msg" => "Sorry! You Have not added Any Item"); 
	}
	else
	{
		while($result=mysqli_fetch_assoc($sql_query1))
		{
			
			$userinfo['product_id']=$result['product_id'];
			$userinfo['product_title']=$result['title'];
			$userinfo['product_price']=$result['price'];
			$userinfo['product_category']=$result['category'];
			$userinfo['product_image']=$result['pro_image'];
			$userinfo['product_description']=$result['description'];
			$userinfo['product_uploadOn']=$result['upload_on'];
			$array[]=$userinfo;
		}
		if($result_rows==1){ $result_found="item"; } else{ $result_found="items"; }
		$json = array("status" => 1, "msg" => " You Have added <b> $result_rows </b> $result_found so far","rows"=>$result_rows,$array);
	}
}
else
{
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait...";
	die;
}
?>