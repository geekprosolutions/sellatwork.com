<?php
include_once 'connection.php' ;
$method = $_SERVER['REQUEST_METHOD']; 
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
	$BlacklistAccounts=array("gm1ail.com","yahoo.com","outlook.com","zoho.com","rediff.com","hotmail.com","mail.com","bigstring.com","shortmail.com","inbox.com","lavabit.com","facebook.com","myspace.com","aol.com");
	
	$WhiteListDomains=array("lmco.com","walmartlabs.com","samsung.com","trimble.com","lockheedmartin.com","amazon.com","juniper.net","scu.edu","cognizant.com","google.com","apple.com","fb.com","yahoo-inc.com","linkedin.com","cisco.com","netapp.com","symantec.com","adobe.com","microsoft.com","hp.com","intel.com","oracle.com","intuit.com","ebay.com","paypal.com","netflix.com","zynga.com","teslamotors.com","teradata.com","claraview.com") ;
	
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

	$company_name=isset($_POST['company']) ? $_POST['company'] : " ";
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
		
	if($lat!="" && $lng!="")
	{
		 function getAddress($lat, $lon)
		 {
			$url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lon."&sensor=false";
			$json = @file_get_contents($url);
			$data = json_decode($json);
			$status = $data->status;
			$address = '';
			if($status == "OK")
			{
			  $address = $data->results[2]->formatted_address;
			}
			return  $data;
		  }

		  $add=getAddress($lat,$lng);

		$geoResults = [];
		foreach($add->results as $result)
		{
			$geoResult = [];    
			foreach ($result->address_components as $address) {
				if ($address->types[0] == 'country') {
					$geoResult['country'] = $address->long_name;
				}
				if ($address->types[0] == 'administrative_area_level_1') {
					$geoResult['state'] = $address->long_name;
				}
				if ($address->types[0] == 'administrative_area_level_2') {
					$geoResult['county'] = $address->long_name;
				}
				if ($address->types[0] == 'locality') {
					$geoResult['city'] = $address->long_name;
				}
				if ($address->types[0] == 'postal_code') {
					$geoResult['postal_code'] = $address->long_name;
				}       
				if ($address->types[0] == 'route') {
					$geoResult['route'] = $address->long_name;
				}       
			}
			$geoResults[] = $geoResult;
			
		}

		$city=$geoResults[0]['city'];
		$state=$geoResults[0]['state'];
		$country=$geoResults[0]['country'];
	}
	else
	{
		
		$city=isset($_COOKIE["UserCity"]) ? $_COOKIE["UserCity"] : "Mountain View" ;
		$state=isset($_COOKIE["UserState"]) ? $_COOKIE["UserState"] : "California";
		$country=isset($_COOKIE["UserCountry"]) ? $_COOKIE["UserCountry"] : "United States";
	}	
		
		
	
	$userphoto=$url_root."upload/defaultUserPic.jpg"; // Default user Image 
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	  $emailError="* Invalid Email";
	  $json = array("status" => 0, "msg" => "Error adding user ! ", "emailError" => $emailError ); // If Email is Invalid
	}
	else
	{
		
		$password=$_POST['pwd'];
		// Encrypt Password
		$hashAndSalt = password_hash($password, PASSWORD_BCRYPT);
		$pwd=$hashAndSalt;	
		
		$login_method="Website"; // login via website or social media
		$verified="Not Verified";
		
		// Check if user already exists in database
		$sql_query1=mysqli_query($conn,"select * from users where email='$email' ") ;
		$sql_query1_rows=mysqli_num_rows($sql_query1);
		if($sql_query1_rows!=0)
		{
			$json = array("status" => 0, "msg" => "Sorry! Email already Exists", "emailError" => "Email Already in use "); // if username or email already exists
		}
		else
		{
			// Insert data into data base
			$sql_query2=mysqli_query($conn,"insert into users (username,email,password,city,state,country,location,lattitude,longitude,userphoto,company_name,loginvia,join_on,account_verified) values('$name','$email','$pwd','$city','$state','$country','$location','$lat','$lng','$userphoto','$company_name','$login_method','$current_date','$verified')");
			if($sql_query2)
			{
				
				$user_id=mysqli_insert_id($conn);
				// Generate A token/code
				$timestampz=time();
				function generateRandomString($length = 40) 
				{
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) 
					{
						$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					return $randomString;
				}
				$tokenparta = generateRandomString();
				$code = $timestampz*3 . $tokenparta;
				$sql_query=mysqli_query($conn,"update users set account_verification_code='$code' where user_id='".$user_id."' and account_verified='Not Verified' "); 
				
				// Message body
				$body= '<body>
					<div style="background-color: #fff;margin: auto;padding-top:5px; padding-bottom:5px; text-align: center; width: 100%;">	
						<p style="text-align:center;  color:#F0524F; font-size:22px; font-family:sans-serif;">SellAtWork.com</p>
					</div> 					
						<div style="height:auto; border:1px solid #ededed; padding:15px; float:left; background-color:#F9F9F9; margin-top:10px; margin-bottom:10px; text-align:left;width: 100%;">									  
							 <div style=" padding: 1px 11px 8px;">							 
									 <p style="color: #F55B44;font-family: arial;font-size: 18px;font-weight: 200;line-height: 21px; text-align: left;">Hello</p> 
									 <p style="color: #6C6C74;font-family: arial;font-size: 14px;font-weight: 100;  text-align: left;">
									 Click The verify Button to verify   <span style="color:#5FADD9; font-weight:700;"> '. $email.'  </p>
													<div style="padding: 5px 0 13px; margin-top:1em;">                                                                        							 
													<a href="'.$url_root.'verifyAccount.php?response_status=1&verify=true&verification_code='.$code.'&verification_id='.$user_id.'" style="background-color: #f55b44;
	border: medium none;  border-radius: 2px;  color: #fff; font-family: sans-serif;  text-decoration: none; font-size:14px;  font-weight: 500;  margin: 0.5em 0 0;  padding:11px 23px;"> VERIFY </a> <br/>													
													<p style="color: #6C6C74;font-family: arial; margin-top:2em;font-size: 14px;font-weight: 100;  text-align: left;">
									Thanks for verifying your Email !</p>
									 <p style="color: #6c6c74;font-family: arial;font-size: 14px;font-weight: 100;  text-align: left;">
											 Please note if you click the button and it appears to be broken please copy and paste 
											 <a href="'.$url_root.'verifyAccount.php?response_status=1&verify=true&verification_code='.$code.'&verification_id='.$user_id.'" style="color:#5fadd9; text-decoration:none;">'.$url_root.'verifyAccount.php?response_status=1&verify=true&verification_code='.$code.'&verification_id='.$user_id.' </a>  into a
													new browser <br/> window if you did not register with this email id on SellAtWork.com please ignore this message
													</p>
													</div>
												</div> 
											</div>	
				 <p style="text-decoration:underline; color:#5FADD9; font-family: sans-serif; font-size: 17px;padding-top: 5px;text-align: center;">SellAtWork.com</p>
									</body>';
				
				// Include Send Message 
				require 'PHPMailerAutoload.php';
				$mail = new PHPMailer;
				//$mail->SMTPDebug = 3;                               // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'email-smtp.us-west-2.amazonaws.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'AKIAJFGQ7AMOZIVGV7XA';                 // SMTP username
				$mail->Password = 'Amqwy3gsim0s7BKu24/B13C2S3oab8RIjR+VuT8pVcIN';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                   // TCP port to connect to
				$mail->setFrom('support@sellatwork.com', 'SellatWork');
				$mail->addAddress($email, '');     // Add a recipient
				$mail->addCC('');
				$mail->addBCC('');
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Please verify your SellAtWork Account email address';
				$mail->Body    = $body;

				if(!$mail->send()) 
				{
					$json = array("status" => 1, "msg" => "User Register Successfully! Problem in Sending Email  ","emailError" => "");
				    //$mail->ErrorInfo;
				} 
				else 
				{
					$json = array("status" => 1, "msg" => "User Register Successfully!.Verification Email Has been Sent To Your Email. Please Verfiy Your Account ","emailError" => "");
				}
								
			}
			else
			{
				$json = array("status" => 0, "msg" => "Error Registering user!", "emailError" => "");
			}
		}
	}
}
else
{
	$json = array("status" => 0, "msg" => "Request method not accepted","emailError" => "" ); // If Request method is not Post
}
mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>