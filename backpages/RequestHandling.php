<?php
include "connection.php";
if(isset($_SESSION['session_web']['valid']))
{
	$method = $_SERVER['REQUEST_METHOD'];
	if($method == "POST")
	{
		$action=$_POST['action'];
		$message_id=$_POST['message_id'];
		
		// delete message request that Logged In User had Received
		if($action=="delete")
		{
			$sql_query=mysqli_query($conn,"delete from message_box where message_id=$message_id and receiver_id='".$_SESSION['session_web']['login_userId']."' ") ;
			if($sql_query)
			{
				$json=array("status"=>1,"msg"=>"Request Deleted");
			}
			else
			{
				$json=array("status"=>0,"msg"=>"Something Went Wrong! Try Again");
			}
		}
		
		// Reply To The Request
		if($action=="reply")
		{
			$original_message_sender_id=$_POST['original_message_sender_id'];
			$original_message_receiver_id=$_POST['original_message_receiver_id'];
			
			if($_SESSION['session_web']['login_userId']==$original_message_sender_id) //  Who Requested
			{
				$product_owner_reply="";
				$request_user_reply=mysqli_real_escape_string($conn,$_POST['message']);
				$product_owner_reply_time="";
				$request_user_reply_time=$current_date_time;
			}
			else // whose Product
			{
				$product_owner_reply=mysqli_real_escape_string($conn,$_POST['message']);
				$request_user_reply="";
				$product_owner_reply_time=$current_date_time;
				$request_user_reply_time="";				
			}
			$sql_query=mysqli_query($conn,"insert into message_reply(message_id,product_owner_id,request_user_id,product_owner_reply,request_user_reply,product_owner_reply_time,request_user_reply_time)
			values($message_id,$original_message_receiver_id,$original_message_sender_id,'$product_owner_reply','$request_user_reply','$product_owner_reply_time','$request_user_reply_time');");
			if($sql_query)
			{
				$json=array("status"=>1,"msg"=>"Message Sent");
			}
			else
			{
				$json=array("status"=>0,"msg"=>"Something Went Wrong! Try Again");
			}
		}
		
	}
	else
	{
		$json = array("status" => 0, "msg" => "Request method not accepted"); // If Request method is not Post
	}
}
else
{
	$json = array("status" => 0, "msg" => " Unauthorized Access! " ); // If connection fail
}
header('Content-type: application/json'); // Output header 
echo json_encode($json);

?>