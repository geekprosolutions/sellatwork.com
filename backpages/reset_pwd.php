<?php

include_once 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
	// Validate data
	$token=$_POST['token'];
	$password=$_POST['password'];
	
	
		$sql_query=mysqli_query($conn,"select * from password_recovery where reset_token='$token' ") or die(mysqli_error($conn)."Error");
		$num_rows=mysqli_num_rows($sql_query);
		if($num_rows==1)
		{
			$hashAndSalt = password_hash($password, PASSWORD_BCRYPT);
			$pwd=$hashAndSalt;	
			$fetch=mysqli_fetch_array($sql_query);
			$email=$fetch['user_email'];
			$user_id=$fetch['user_id'];
			$sql_query2=mysqli_query($conn,"update users set password='$pwd',password_reset_date='$current_date_time' where email='$email' and user_id=$user_id ");
			//$sql_query3=mysqli_query($conn,"delete from password_recovery where user_email='$email' and user_id=$user_id and reset_token='$token' ");
			
			$sql_query10=mysqli_query($conn,"select * from users where email='$email' and user_id=$user_id");
			$result=mysqli_fetch_array($sql_query10);
			//Login user
			$login_status=1;
			$_SESSION['session_web']['valid']=true;
			$_SESSION['session_web']['login_userName']=$result['username'];
			$_SESSION['session_web']['login_userStatus']="Online";
			$_SESSION['session_web']['login_userId']=$result['user_id'];
			$_SESSION['session_web']['login_userEmail']=$result['email'];
			$_SESSION['session_web']['login_userPhoto']=$result['userphoto'];
			$_SESSION['session_web']['login_userVerified']=$result['account_verified'];
			$_SESSION['session_web']['login_userCompanyVerified']=$result['company_verified'];
			
			// Update User table
			$sql_query2=mysqli_query($conn,"update users set last_login_on='$current_date_time',login_status=$login_status where email='$email' and user_id=$user_id ");
			
			$json = array("status" => 1, "msg" => "Password Changed.");
		}
		else
		{
			$json = array("status" => 0, "msg" => "Unauthorized Access" ); // If Email and token is Invalid
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