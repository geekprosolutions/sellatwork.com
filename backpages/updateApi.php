<?php
include_once 'connection.php' ;
include_once 'userinfo.php';
$nameError=$emailError=$oldPwdError=""; // Error Variables
$method = $_SERVER['REQUEST_METHOD']; 
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
	if(isset($_POST['info']) && $_POST['info']=="basic")
	{
		// Validate data
		function test_input($data) 
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		// Get data
		$name=test_input($_POST['username']);
		$email=$_POST['email'];
		$company_name=test_input($_POST['company_name']);
		
		$location=$_POST['location'];
		$Address = urlencode($location);
		$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
		$xml = simplexml_load_file($request_url) or die("url not loading");

		$status = $xml->status;
		if ($status=="OK") 
		{
		  $lat = $xml->result->geometry->location->lat;
		  $lng = $xml->result->geometry->location->lng;
		}
		else
		{
		   $lat=isset($_COOKIE["UserLatitude"]) ?$_COOKIE["UserLatitude"] : "37.386052";
		   $lng=isset($_COOKIE["UserLongitude"]) ? $_COOKIE["UserLongitude"] : "-122.083851";
		}
		
		
		$city=isset($_COOKIE["UserCity"]) ? $_COOKIE["UserCity"] : "Mountain View" ;
		$state=isset($_COOKIE["UserState"]) ? $_COOKIE["UserState"] : "California";
		$country=isset($_COOKIE["UserCountry"]) ? $_COOKIE["UserCountry"] : "United States";
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
		  $emailError="* Invalid Email";
		  $json = array("status" => 0, "msg" => "Error Updating user ! ", "emailError" => $emailError , "nameError" => $nameError ,"oldPwdError"=> $oldPwdError); // If Email is Invalid
		}
		else
		{
				
			// Check if user already exists in database
			$sql_query1=mysqli_query($conn,"select * from users where user_id!='" .$json[0]['user_id'] ."' and( username='$name' or email='$email') ") ;
			$sql_query1_rows=mysqli_num_rows($sql_query1);
			if($sql_query1_rows!=0)
			{
				$json = array("status" => 0, "msg" => "Sorry! Username or Email already Exists", "emailError" => $emailError, "nameError" => $nameError); // if username or email already exists
			}
			else
			{
				// Update data into data base
				$sql_query2=mysqli_query($conn,"update users set username='$name',email='$email',city='$city',state='$state',country='$country',company_name='$company_name',location='$location',lattitude='$lat',longitude='$lng' where user_id='".$json[0]['user_id']."' ");
				
				$sql_query2=mysqli_query($conn,"update products set company_name='$company_name' where user_id='".$json[0]['user_id']."' ");
				
				
				if($sql_query2)
				{
					$_SESSION['session_web']['login_userName']=$name;
					$_SESSION['session_web']['login_userStatus']="Online";
					$_SESSION['session_web']['login_userEmail']=$email;				
					
					$json = array("status" => 1, "msg" => "Done User data Updated!","emailError" => $emailError , "nameError" => $nameError,"oldPwdError"=> $oldPwdError);
				}
				else
				{
					$json = array("status" => 0, "msg" => "Error Updating  data !", "emailError" => $emailError , "nameError" => $nameError,"oldPwdError"=> $oldPwdError);
				}
			}
		}
	}
	
	else
	{
		$password=$_POST['oldpwd'];
		$new_password=$_POST['newpwd'];
		
		$oldpwd=$json[0]['password'];
		
		if (password_verify($password,$oldpwd))
		{
		   // Encrypt Password
			$hashAndSalt = password_hash($new_password, PASSWORD_BCRYPT);
			$pwd=$hashAndSalt;
			
			// Update data into data base
			$sql_query2=mysqli_query($conn,"update users set password='$pwd' where user_id='".$json[0]['user_id']."' ");
			if($sql_query2)
			{
				$json = array("status" => 1, "msg" => "Done User data Updated!","emailError" => $emailError , "nameError" => $nameError,"oldPwdError"=> $oldPwdError);
			}
			else
			{
				$json = array("status" => 0, "msg" => "Error Updating data !", "emailError" => "" , "nameError" => "","oldPwdError"=> "");
			}
			
		} 
		else 
		{
			$oldPwdError="* Old Password Is Wrong ";
			$json = array("status" => 0, "msg" => "Password is incorrect ! ", "emailError" => "" , "nameError" => "","oldPwdError"=> $oldPwdError);
		}

	
	}
}
else
{
	$json = array("status" => 0, "msg" => "Request method not accepted","emailError" => $emailError , "nameError" => $nameError,"oldPwdError"=> $oldPwdError); // If Request method is not Post
}
mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>