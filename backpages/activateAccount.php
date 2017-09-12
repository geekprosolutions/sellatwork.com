<?php
include_once 'connection.php';
if(!isset($_SESSION['session_web']['valid'])&& $_SESSION['session_web']['valid']==true)
{
	header('Refresh:1;url='.$url_root.'login.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait...";
	die;	
}

$method = $_SERVER['REQUEST_METHOD'];
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
	// Validate data
	$code=$_POST['code'];
	
		$sql_query1=mysqli_query($conn,"select * from users where user_id='".$_SESSION['session_web']['login_userId'] ."' and verification_code='$code' ");
		$num_rows=mysqli_num_rows($sql_query1);
		if($num_rows==1)
		{
			$sql_query2=mysqli_query($conn,"update users set verification_code='$code',verified='Verified'  where user_id='".$_SESSION['session_web']['login_userId']."' ");
			
			$json = array("status" => 1, "msg" => "Account Activated. Please Login To Continue","codeError"=>"");
			
		}
		else
		{
			$codeError="* Invalid Code";
			$json = array("status" => 0, "msg" => "Invalid Code! ", "codeError" => $codeError);
		}
}
else
{
	$json = array("status" => 0, "msg" => "Request method not accepted","codeError" => ""); // If Request method is not Post
}

mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>