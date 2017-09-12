<?php 

include "connection.php";
$method=$_SERVER['REQUEST_METHOD'];
if($method=="POST")
{
	$email=$_POST['email'];
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$emailError="Invalid Email";
		$json=array("status"=>0,"msg"=>"Invalid Email","emailError"=>$emailError);
	}
	
	else
	{
		
		
		$message=mysqli_real_escape_string($conn,$_POST['message']);
					
		$body = '<body>
							<div style="background-color: #fff;margin: auto;padding-top:5px; padding-bottom:5px; text-align: center; width: 100%;">	
								<p style="text-align:center;  color:#F0524F; font-size:22px; font-family:sans-serif;">SellAtWork.com</p>
							</div> 					
							<div style="height:auto; border:1px solid #ededed; padding:15px; float:left; background-color:#F9F9F9; margin-top:10px; margin-bottom:10px; text-align:left;width: 97%;">									  
								<div style=" padding: 1px 11px 8px;">
								 <p style="color: #F55B44;font-family: arial;font-size: 18px;font-weight: 200;line-height: 21px; text-align: left;">Hello</p> 
									<p style="color:#676767;font-family: sans-serif;font-size: 15px;font-weight:100;line-height: 21px;text-align: justify;">
									'.$message.' </p>
								 <span style="color:#6A5C65;     padding-left: 9px; font-size: 12px; line-height:18px; font-family:sans-serif;">To respond to this email click <a href="mailto:'.$email.'?Subject=Message From Sellatwork.com" target="_top" style="text-decoration:none; color:#5FADD9;">Here</a></span>
								</div>
							</div> 
							<br/>
							 <p style="text-decoration:underline; color:#5FADD9; font-family: sans-serif; font-size: 17px;padding-top: 5px;text-align: center;">SellAtWork.com</p>			
						</body> ';
						 
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
			$mail->setFrom('support@sellatwork.com','SellatWork');
			$mail->addAddress('sellatwork@gmail.com', 'SellatWork');     // Add a recipient
			//$mail->addCC('');
			//$mail->addBCC('');
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Message To Sellatwork.com ';
			$mail->Body    = $body;

			if(!$mail->send()) 
			{
				$json = array("status" => 0, "msg" => "Message could not be sent","emailError"=>"");
				//$mail->ErrorInfo;
			} 
			else 
			{
				$json = array("status" => 1, "msg" => "Email has Been Sent Successfully","emailError"=>"");
			}			
		//Send Email Ends
	}
}
else
{
	$json=array("status" => 0, "msg" => "Request Method not Accepted","emailError"=>"");
}

header('Content-type: Application/json');
echo json_encode($json);

?>