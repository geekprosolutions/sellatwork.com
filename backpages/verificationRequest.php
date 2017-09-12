<?php
include_once 'connection.php';
if(!isset($_SESSION['session_web']['valid'])&& $_SESSION['session_web']['valid']==true)
{
	header('Refresh:1;url='.$url_root.'login.php');
	echo "Unauthorized Access!! Please Login To Begin.Redirecting Please Wait..." ; 
	die;	
}
else
{
	$method = $_SERVER['REQUEST_METHOD'];
	$_POST = json_decode(file_get_contents('php://input'), true);

	if($method == "POST")
	{
		$verification = $_POST['verification'];
		if($verification=="via_email")
		{
			$email = $_POST['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
			  $emailError="* Invalid Email";
			  $json = array("status" => 0, "msg" => "Can Not Verify Your Account", "emailError" => $emailError ,"codeError" => "");
			}
			else
			{
				
				$BlacklistAccounts=array("gm1ail.com","yahoo.com","outlook.com","zoho.com","rediff.com","hotmail.com","mail.com","bigstring.com","shortmail.com","inbox.com","lavabit.com","facebook.com","myspace.com","aol.com");
				$WhiteListDomains=array("lmco.com","walmartlabs.com","samsung.com","trimble.com","lockheedmartin.com","amazon.com","juniper.net","scu.edu","cognizant.com","google.com","apple.com","fb.com","yahoo-inc.com","linkedin.com","cisco.com","netapp.com","symantec.com","adobe.com","microsoft.com","hp.com","intel.com","oracle.com","intuit.com","ebay.com","paypal.com","netflix.com","zynga.com","teslamotors.com","teradata.com","claraview.com");
				
				
				// Check for email Validation
				$trim_email=explode("@",$email);
				$domain=$trim_email[1];
				if(in_array($domain,$BlacklistAccounts))
				{
					$json = array("status" => 0, "msg" => "Sorry! This Domain Is not Available For Company Verification.","emailError"=>"","codeError"=>"");
				}
				else
				{
					$whitelist=1;
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
					$sql_query2=mysqli_query($conn,"update users set domain='$domain',whitelist=$whitelist,company_emailId='$email',company_verification_code='$code',company_verified='Not Verified' where user_id='".$_SESSION['session_web']['login_userId']."' ");
					
					// Get HTML contents from file
					$body = '<body>
							<div style="background-color: #fff;margin: auto;padding-top:5px; padding-bottom:5px; text-align: center; width: 100%;">	
								<p style="text-align:center;  color:#F0524F; font-size:22px; font-family:sans-serif;">SellAtWork.com</p>
							</div> 					
								<div style="height:auto; border:1px solid #ededed; padding:15px; float:left; background-color:#F9F9F9; margin-top:10px; margin-bottom:10px; text-align:left;width: 100%;">									  
									 <div style=" padding: 1px 11px 8px;">							 
											 <p style="color: #F55B44;font-family: arial;font-size: 18px;font-weight: 200;line-height: 21px; text-align: left;">Hello</p> 
											 <p style="color: #6C6C74;font-family: arial;font-size: 14px;font-weight: 100;  text-align: left;">
											 Click The verify Button to verify   <span style="color:#5FADD9; font-weight:700;"> '. $email.'  </p>
															<div style="padding: 5px 0 13px; margin-top:1em;">                                                                        							 
															<a href="'.$url_root.'verifyCompany.php?response_status=1&verify=true&verification_code='.$code.'&verification_id='.$_SESSION['session_web']['login_userId'].'" style="background-color: #f55b44;
			border: medium none;  border-radius: 2px;  color: #fff; font-family: sans-serif;  text-decoration: none; font-size:14px;  font-weight: 500;  margin: 0.5em 0 0;  padding:11px 23px;"> VERIFY </a> <br/>													
															<p style="color: #6C6C74;font-family: arial; margin-top:2em;font-size: 14px;font-weight: 100;  text-align: left;">
											Thanks for verifying your Email !</p>
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
						$mail->Subject = 'Please verify your company email address';
						$mail->Body    = $body;

						if(!$mail->send()) 
						{
							$json = array("status" => 0, "msg" => "Message could not be sent","emailError"=>"","codeError"=>"");
							//$mail->ErrorInfo;
						} 
						else 
						{
							$json = array("status" => 1, "msg" => "Verification Email Sent Please Check Your Email","emailError"=>"","codeError"=>"");
						}
				}
			}
		}
		elseif($verification=="via_code")
		{
			$company_code = $_POST['company_code'];
			$sql_query2=mysqli_query($conn,"select * from company_code where company_code='$company_code' ") ;
			$sql_rows=mysqli_num_rows($sql_query2);
			if($sql_rows==0)
			{
				$codeError="* Code Is Invalid ";
				$json = array("status" => 0, "msg" => "Invalid Code", "emailError" =>"","codeError"=>$codeError);
			}
			else
			{
				$sql_query2=mysqli_query($conn,"update users set company_verified='Verified'  where user_id='".$_SESSION['session_web']['login_userId']."'" );
				$json = array("status" => 1, "msg" => "Company is Verified", "emailError" =>"","codeError"=>"");
				$_SESSION['session_web']['login_userCompanyVerified']="Verified";
			}
		}
	}
	else
	{
		$json = array("status" => 0, "msg" => "Request method not accepted","emailError" => "","codeError"=>""); // If Request method is not Post
	}

	mysqli_close($conn);// Close Connection
	header('Content-type: application/json'); // Output header 
	echo json_encode($json);
}
?>