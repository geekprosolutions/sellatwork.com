<?php
// Page is included in MessageChat.php 
// All The Chat Info Regarding a Product Requested 

if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
{
	$method=$_SERVER['REQUEST_METHOD'];
	if($method!="GET")
	{
		header('Refresh:1;url='.$url_root.'index.php');
		echo "Request Method Not Accepted.Redirecting Please Wait..." ; 
		die;
	}
	else
	{
		$request=$_GET['request'];
		$req=explode("-",$request);
		$receiver_id=$req[0]; // Who Uploaded the Product
		$product_id=$req[1];
		
		// Product Details
		$query=mysqli_query($conn,"select * from products where product_id=$product_id ");
		$result2=mysqli_fetch_array($query);
		$product_title=$result2['title'];
		$product_price=$result2['price'];
		$product_category=$result2['category'];
		$product_image=$result2['pro_image'];
		$product_uploadOn=$result2['upload_on'];
		
		// Message detail
		$sql_query=mysqli_query($conn,"select * from message_box where receiver_id=$receiver_id and product_id=$product_id order by message_id desc limit 1");
		$num_rows=mysqli_num_rows($sql_query);
		if($num_rows==1)
		{
			$sql_result=mysqli_fetch_array($sql_query);
			$msg_sender_id=$sql_result['sender_id']; // Who Requested for Product
			$or_message=$sql_result['message'];
			$or_message_id=$sql_result['message_id'];
			$or_message_sent_on=$sql_result['sent_on'];
			$msg_sender_email=$sql_result['sender_email'];
			
			// All The Replies for the Message
			$sql_query1=mysqli_query($conn,"select * from message_reply where message_id=$or_message_id order by reply_id desc") ;
			$rows=mysqli_num_rows($sql_query1);
			if($rows==0)
			{
				$json=array("status"=>0,"msg"=>"Not Replied Yet","original_message_id"=>$or_message_id,"original_message"=>$or_message,"original_message_date"=>$or_message_sent_on,"product_title"=>$product_title,"product_price"=>$product_price,"product_category"=>$product_category,"product_image"=>$product_image,"product_uploadOn"=>$product_uploadOn,"msg_sender_email"=>$msg_sender_email,"original_message_receiver_id"=>$receiver_id,"original_message_sender_id"=>$msg_sender_id );
			}
			else
			{
				$reply_array=array();
				while($fetch=mysqli_fetch_array($sql_query1))
				{
					$reply_msg['reply_id']=$fetch['reply_id'];
					$reply_msg['product_owner_id']=$fetch['product_owner_id']; // Who Uploaded Product
					$sql=mysqli_query($conn,"select * from users where user_id='".$reply_msg['product_owner_id']."' ") or die (mysqli_error($conn)."Error");
					$result=mysqli_fetch_array($sql);
					$reply_msg['product_owner_photo']=$result['userphoto'];
					$reply_msg['request_user_id']=$fetch['request_user_id']; // Who shows Interest In Product
					$sql1=mysqli_query($conn,"select * from users where user_id='".$reply_msg['request_user_id']."' ") or die (mysqli_error($conn)."Error");
					$result1=mysqli_fetch_array($sql1);
					$reply_msg['product_owner_reply']=$fetch['product_owner_reply'];  
					$reply_msg['product_owner_reply_time']=$fetch['product_owner_reply_time'];
					$reply_msg['request_user_reply']=$fetch['request_user_reply'];
					$reply_msg['request_user_photo']=$result1['userphoto'];
					$reply_msg['request_user_reply_time']=$fetch['request_user_reply_time'];
					
					array_push($reply_array,$reply_msg);
				}
				if($rows==1){$var="reply was found";}else{$var="replies were found";}
				$json=array("status"=>1,"msg"=>"$rows $var ","original_message_id"=>$or_message_id,"original_message"=>$or_message,"original_message_date"=>$or_message_sent_on,"product_title"=>$product_title,"product_price"=>$product_price,"product_category"=>$product_category,"product_image"=>$product_image,"product_uploadOn"=>$product_uploadOn,"msg_sender_email"=>$msg_sender_email,"original_message_receiver_id"=>$receiver_id,"original_message_sender_id"=>$msg_sender_id,$reply_array);
			}
		}
		else
		{
			header('Refresh:1;url='.$url_root.'index.php');
			echo "Product Not Found In Database.Redirecting Please Wait..." ; 
			die;
		}
		
	}

}
else
{
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Unauthorized Access! Please Login To Begin.Redirecting Please Wait..." ; 
	die;
}
?>