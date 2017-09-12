<?php
// Page Is Included  in myrequest.php 
if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
{
	// Get Messages That LoggedIn User Has sent for The requested Product
	$sql_query1=mysqli_query($conn,"select * from message_box where sender_id='".$_SESSION['session_web']['login_userId']."' order by message_id desc");
	$result_rows=mysqli_num_rows($sql_query1);
	if($result_rows==0)
	{
		$json = array("status" => 0, "msg" => "Sorry! You Have not Requested Any Item"); 
	}
	else
	{
		while($result=mysqli_fetch_assoc($sql_query1))
		{
			
			$userinfo['product_id']=$result['product_id'];
			$userinfo['message_id']=$result['message_id'];
			$userinfo['receiver_id']=$result['receiver_id'];
			$userinfo['message_sent_on']=$result['sent_on'];
			
			$sql_query2=mysqli_query($conn,"select * from products where product_id='".$result['product_id']."'");
			$request=mysqli_fetch_array($sql_query2);
			$userinfo['product_title']=$request['title'];
			$userinfo['product_price']=$request['price'];
			$userinfo['product_category']=$request['category'];
			$userinfo['product_image']=$request['pro_image'];
			$userinfo['product_description']=$request['description'];
			$userinfo['product_uploadOn']=$request['upload_on'];
			$array[]=$userinfo;
		}
		if($result_rows==1){ $result_found="item"; } else{ $result_found="items"; }
		$json = array("status" => 1, "msg" => " You Have requested <b> $result_rows </b> $result_found so far","rows"=>$result_rows,$array);
	}
}
else
{
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait...";
	die;
}
?>