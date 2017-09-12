<?php
include_once 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
			
	$email=$_POST['email'];
	$password=$_POST['pwd'];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	  $emailError="* Invalid Email";
	  $json = array("status" => 0, "msg" => "Login Failed! Invalid Email. ", "emailError" => $emailError ); // If Email is Invalid  
	}
	else
	{


		// Check if user exist in database or not
		$sql_query1=mysqli_query($conn,"select * from users where email='$email' and password!='' ");
		$num_rows=mysqli_num_rows($sql_query1);
		if($num_rows==1)
		{
			$result=mysqli_fetch_array($sql_query1);
			$pwd=$result['password'];
			
			if (password_verify($password, $pwd))
			{
				if($result['account_verified']=="Not Verified")
				{
					$json = array("status" => 0, "msg" => "Please check Your email to verify your account. ","emailError" =>""); // If Login Credential fails
				}
				else
				{
					$login_status=1;
					$_SESSION['session_web']['valid']=true;
					$_SESSION['session_web']['login_userName']=$result['username'];
					$_SESSION['session_web']['login_userStatus']="Online";
					$_SESSION['session_web']['login_userId']=$result['user_id'];
					$_SESSION['session_web']['login_userEmail']=$result['email'];
					$_SESSION['session_web']['login_userPhoto']=$result['userphoto'];
					$_SESSION['session_web']['login_userVerified']=$result['account_verified'];
					$_SESSION['session_web']['login_userCompanyVerified']=$result['company_verified'];
					
					
					$_SESSION['session_web']['login_Counter']=$result['login_counter'];
					$_SESSION['session_web']['index_page_visit']=0;
					$new_login_counter=$result['login_counter']+1;
					// Update User table
					if(isset($_SESSION['session_web']['last_url']) )
					{
						if(strpos($_SESSION['session_web']['last_url'],'signup.php') !== false  || strpos($_SESSION['session_web']['last_url'],'login.php')!== false || strpos($_SESSION['session_web']['last_url'],'forgotPassword.php') !== false || strpos($_SESSION['session_web']['last_url'],'verification.php')!== false ) 
						{
							$location="index.php";
						} 
						else 
						{
							$location=$_SESSION['session_web']['last_url'];
						}
						
					}
					else
					{
						$location="index.php";
					}
					$sql_query2=mysqli_query($conn,"update users set last_login_on='$current_date_time',login_status=$login_status,login_counter=$new_login_counter where email='$email' and password='$pwd' ");
					$json = array("status" => 1, "msg" => "Login Successfully","emailError" =>"","location"=>$location); // If Login is Successfull
				}
			}
			else
			{
				$json = array("status" => 0, "msg" => "Invalid Login Credentials !","emailError" =>""); // If Login Credential fails
			}
		}
		else
		{
			$json = array("status" => 0, "msg" => "Invalid Login Credentials !","emailError" =>""); // If Login Credential fails
		}
	}
}
else
{
	$json = array("status" => 0, "msg" => "Request method not accepted","emailError" =>""); // If Request method is not Post
}

mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>