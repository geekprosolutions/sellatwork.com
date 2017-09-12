<?php
ob_start();
session_start();
session_destroy(); // destroy any session if exist
include_once '../backpages/connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
	// Validate data
	function test_input($data) 
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$name=test_input($_POST['name']);
	$password=$_POST['pwd'];
	$login_status=1;
	
	// Check if user exist in database or not
	$sql_query1=mysqli_query($conn,"select * from admin where username='$name' and password='$password' ");
	$num_rows=mysqli_num_rows($sql_query1);
	if($num_rows==1)
	{
		$result=mysqli_fetch_assoc($sql_query1);
		$_SESSION['session_admin_web']['valid']=true;
		$_SESSION['session_admin_web']['login_userName']=$name;
		$_SESSION['session_admin_web']['login_userStatus']="Online";
		$_SESSION['session_admin_web']['login_userId']=$result['admin_id'];
		$_SESSION['session_admin_web']['login_userPhoto']=$url_root.$result['userphoto'];
		$_SESSION['session_admin_web']['login_url_root']=$result['url_root'];
		
		// Update User table
		$sql_query2=mysqli_query($conn,"update admin set last_login_on='$current_date_time',login_status=$login_status where username='$name' and password='$password' ");
		$json = array("status" => 1, "msg" => "Login Successfully"); // If Login is Successfull
	}
	else
	{
		$json = array("status" => 0, "msg" => "Invalid Login Credentials !"); // If Login Credential fails
	}
}
else
{
	$json = array("status" => 0, "msg" => "Request method not accepted"); // If Request method is not Post
}
mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>