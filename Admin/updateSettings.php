<?php
ob_start();
session_start();
include '../backpages/connection.php';

$method = $_SERVER['REQUEST_METHOD']; 
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
	
		$username=$_POST['username'];
		$password=$_POST['old_pwd'];
		$new_password=$_POST['new_pwd'];
		
		$sql_query=mysqli_query($conn,"select * from admin where admin_id='".$_SESSION['session_admin_web']['login_userId']."' ");
		$result=mysqli_fetch_array($sql_query);
		$oldpwd=$result['password'];
		if($password!=$oldpwd)
		{
			$oldPwdError="* Incorrect  Password";
			$json = array("status" => 0, "msg" => "Error Updating ! ","oldPwdError"=> $oldPwdError); 
		}
		else
		{
			// Update data into data base
			$sql_query2=mysqli_query($conn,"update admin set password='$new_password', username='$username' where admin_id='".$_SESSION['session_admin_web']['login_userId']."' ");
			if($sql_query2)
			{
				$json = array("status" => 1, "msg" => "User Data Updated!","oldPwdError"=> "");
			}
			else
			{
				$json = array("status" => 0, "msg" => "Error Updating  data !","oldPwdError"=> "");
			}
		}
	
}
else
{
	$json = array("status" => 0, "msg" => "Request method not accepted","oldPwdError"=> ""); // If Request method is not Post
}
mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>