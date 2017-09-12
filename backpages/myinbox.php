<?php
if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
{
	// Get Messages that LoggedIn User Received //
	$sql_query1=mysqli_query($conn,"select * from message_box where receiver_id='".$_SESSION['session_web']['login_userId']."'  order by message_id desc");
	$result_rows=mysqli_num_rows($sql_query1);
	if($result_rows==0)
	{
		$json = array("status" => 0, "msg" => "Sorry! Your Inbox is Empty"); 
	}
	else
	{
		while($result=mysqli_fetch_assoc($sql_query1))
		{
			$userinfo['message_id']=$result['message_id']; // Original Message Id
			$userinfo['receiver_id']=$result['receiver_id']; // Product Owner Id 
			$userinfo['product_id']=$result['product_id']; // Product Requested for
			
			// product Info
			$sql_query2=mysqli_query($conn,"select * from products where product_id='".$result['product_id']."' ");
			$result2=mysqli_fetch_array($sql_query2);
			$userinfo['product_title']=$result2['title'];
			$userinfo['product_price']=$result2['price'];
			$userinfo['product_category']=$result2['category'];
			$userinfo['product_image']=$result2['pro_image'];
			$userinfo['product_uploadOn']=$result2['upload_on'];
			
			// Person Info Who had sent Request For Product
			$userinfo['sender_email']=$result['sender_email']; // Person's email Who Had Sent Request
			$userinfo['sender_id']=$result['sender_id']; // Person Who Had sent Message / Request 
			$sql_query3=mysqli_query($conn,"select * from users where user_id='".$result['sender_id']."' ");
			$result3=mysqli_fetch_array($sql_query3);
			$userinfo['sender_name']=$result3['username']; // Person name Who Had Sent Request
			$userinfo['message']=$result['message']; // Message Sent By the Person
			$userinfo['sent_on']=$result['sent_on']; // Message Sent on Date
			$array[]=$userinfo;
		}
		if($result_rows==1){ $result_found="message found in your Inbox"; } else{ $result_found="messages were found in your Inbox"; }
		$json = array("status" => 1, "msg" => "<b> $result_rows </b> $result_found ","rows"=>$result_rows,$array);
	}
	
	
}
else
{
	
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Unauthorized Access! Please Login To Begin.Redirecting Please Wait..." ; 
	die;
}
?>