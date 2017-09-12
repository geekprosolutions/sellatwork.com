<?php
include "connection.php";
if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
{
	$method = $_SERVER['REQUEST_METHOD'];
	//$_POST = json_decode(file_get_contents('php://input'), true);
	if($method == "POST")
	{
		 $id=$_POST['id'];
		$sql_query=mysqli_query($conn,"delete from message_box where message_id=$id and sender_id='".$_SESSION['session_web']['login_userId']."' ");
		if($sql_query)
		{
			$json = array("status" => 1, "msg" => "Request Deleted");
		}
		else
		{
			$json = array("status" => 0, "msg" => "Error in Deleting  Request");
		}
		
	}
	else
	{
		$json = array("status" => 0, "msg" => "Request method not accepted"); // If Request method is not Post
	}	
}

mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>