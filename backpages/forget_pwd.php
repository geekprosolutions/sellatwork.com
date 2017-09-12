<?php
include_once 'connection.php';
$method = $_SERVER['REQUEST_METHOD'];
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
	// Validate data
	$email=$_POST['email'];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	  $emailError="* Invalid Email";
	  $json = array("status" => 0, "msg" => "Password Can not be Recovered", "emailError" => $emailError );
	}
	else
	{
		$sql_query1=mysqli_query($conn,"select * from users where email='$email' ");
		$num_rows=mysqli_num_rows($sql_query1);
		if($num_rows==1)
		{
			$result=mysqli_fetch_array($sql_query1);
			$email=$result['email'];
			$user_id=$result['user_id'];
			
			// Generate A token
			$timestampz=time();
			function generateRandomString($length = 40) {
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				return $randomString;
			}
			$tokenparta = generateRandomString();
			$token = $timestampz*3 . $tokenparta;

			$sql_query1=mysqli_query($conn,"insert into password_recovery (user_id,user_email,reset_token,date) values($user_id,'$email','$token','$current_date_time') ");
			
				// Get HTML contents from file
				$body = '<body>
								<div style="background-color: #fff; font-family:sans-serif; margin: auto;padding-top:5px; padding-bottom:5px; text-align: center; width: 100%;">		
									<p style="text-align:center;  color:#F0524F; font-size:22px;">SellAtWork.com</p>	
								</div>
									<div style="height:auto;  border: 1px solid #ededed; padding:10px 10px 22px; float:left; background-color:#F9F9F9; margin-top:10px; margin-bottom:20px; text-align:left;width: 100%;">								  
										<p style="text-align:left;  color:#F0524F; font-size:18px; font-family:sans-serif; padding-left:10px; ">Hello</p>
										<div style="padding:0 10px 8px;">							 
											 <p style="color: #6c6c74;font-family: arial;font-size: 13px;line-height:7px; ">Please Click The Given Link to Reset Your Password: </p> 
											 <div>                                                              
												 <a href="'.$url_root.'resetPassword.php?e='.$token.'" ><button type="button" style="background-color: #f55b44;
													border: medium none; font-family:sans-serif;  border-radius: 2px;  color: #fff;  font-size: 13px;  font-weight: 500;  margin: 0.5em 0 0;  padding:12px 17px;"> RESET PASSWORD</button></a><br/>			
													<p style="color: #6c6c74;font-family: arial;font-size: 14px;font-weight: 100;  text-align: left;">
														Please note if you click the button and it appears to be broken copy please copy and paste 
														<span style="color:#5FADD9;font-weight:700;">
															<a href="'.$url_root.'resetPassword.php?e='.$token.'">this verification link </a> 
														</span>into a new browser <br/> window if you did not register with this email id on SellAtWork.com please ignore this message
													</p> 
											 </div>
											<div class="clear:both;"></div>
										</div>							 
									</div>
									<p style="text-align:center; padding-top:5px; font-family:sans-serif; font-size:17px; text-decoration:underline; color:#5FADD9;">SellAtWork.com</p>								  
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
						//$mail->addCC('');
						//$mail->addBCC('');
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Reset SellAtWork Password';
						$mail->Body    = $body;

						if(!$mail->send()) 
						{
							$json = array("status" => 0, "msg" => "Message could not be sent","emailError"=>"");
							//$mail->ErrorInfo;
						} 
						else 
						{
							$json = array("status" => 1, "msg" => "Recovery Mail Has been Sent. Please Check Your Email","emailError"=>"");
						}
		}
		else
		{
			$json = array("status" => 0, "msg" => "Email Address not Found", "emailError" => "");
		}
	}
}
else
{
	$json = array("status" => 0, "msg" => "Request method not accepted","emailError" => ""); // If Request method is not Post
}

mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>