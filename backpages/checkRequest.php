<?php
include "connection.php";
if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
{
	// Get User Details //
	
	$method=$_SERVER['REQUEST_METHOD'];
	if($method=="POST")
	{
		$request=$_POST['request'];
		$action=$_POST['action'];
		
		$req=explode("-",$request);
		$receiverId=$req[0]; // Product Owner 
		$productId=$req[1];
		if($action=="getDetail")
		{
			$sql_query1=mysqli_query($conn,"select * from message_box where sender_id='".$_SESSION['session_web']['login_userId']."' and product_id='$productId' and receiver_id='$receiverId' ");
			$result_rows=mysqli_num_rows($sql_query1);
			if($result_rows==0)
			{
				$json = array("status" => 0, "msg" => "Not Requested Yet!"); 
			}
			else
			{
				$json = array("status" => 1, "msg" => "Requested");
			}
		}
	}
}
else
{
	$json = array("status" => 0, "msg" => "Unauthorized Access! Please Login To Begin"); // If connection fail
}
mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);

?>