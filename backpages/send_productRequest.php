<?php
include_once 'connection.php';
include "userinfo.php";
$method = $_SERVER['REQUEST_METHOD'];
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
	// Validate data
	$senderEmail=$_POST['email'];
	$Id=$_POST['receiverId'];
	$Id=explode("-",$Id);
	$receiverId=$Id[0];
	$productId=$Id[1];
	$message=mysqli_real_escape_string($conn,$_POST['message']);
	if(!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) 
	{
	  $emailError="* Invalid Email";
	  $json = array("status" => 0, "msg" => "Please Enter Correct Email", "emailError" => $emailError );
	}
	else
	{

		$sql_query1=mysqli_query($conn,"select * from users where user_id=$receiverId ");
		$num_rows=mysqli_num_rows($sql_query1);
		if($num_rows==1)
		{
			$result=mysqli_fetch_array($sql_query1);
			$receiverName=$result['username'];
			$receiverEmail=$result['email'];
			$sql_query2=mysqli_query($conn,"select * from products where product_id=$productId ");
			$result2=mysqli_fetch_array($sql_query2);
			$productTitle=$result2['title'];
			$productPrice=$result2['price'];
			$productCategory=$result2['category'];
			$productImage=$result2['pro_image'];
			$productUploadOn=$result2['upload_on'];
			$senderId=$_SESSION['session_web']['login_userId'];
			
			$sql_query12=mysqli_query($conn,"select * from users where user_id=$senderId");
			$result2=mysqli_fetch_array($sql_query12);
			$Sender_company_name=$result2['company_name'];
			
			$country=$json[0]['country'];
			if($country!="United States" && $country!="U.S"  && $country!="US" && $country!="USA" )
			{
				$approval_status="Not Approved";
			}
			else
			{
				$approval_status="Approved";
			}
			
			// Insert data to message box table
			$sql2=mysqli_query($conn,"insert into message_box(receiver_id,sender_id,product_id,sender_email,message,sent_on,approval_status) values($receiverId,$senderId,$productId,'$senderEmail','$message','$current_date_time','$approval_status') ") ;
			
			if($approval_status=="Approved")
			{
				$message=stripslashes($message);
				$body = '<body>
								<div style="margin:auto;padding: 0;text-align: left;width: 100%;">			
									 <div style="background-color: #fff;margin: auto;padding-top:5px; padding-bottom:5px; text-align: center; width: 100%;">	
								<p style="text-align:center;  color:#F0524F; font-size:22px;font-family: sans-serif;">SellAtWork.com</p>
								</div> 	
										<div style="padding:1px 17px 20px 6px; background-color: #f9f9f9; border: 1px solid #ededed;">	
										<p style="text-align:left;  color:#F0524F; font-size:18px; font-family:sans-serif; padding-left:10px; ">Hello</p>											
										<p style="color: #6c6c74;font-family: arial;font-size: 13px;line-height: 22px;padding-left: 9px;text-align: justify;">
										  User from <b>'. $Sender_company_name.' </b> has sent you a message about your Ad   <a href="'.$url_root.'ViewAd/'.$productId.'" target="_blank" style="text-decoration:none; color:#444;" >'.$productTitle.'</a> on Sellatwork.com. Their email id is '.$senderEmail.'.</p>
										<div style="padding:0;">												
										<span style="color: #6c6c74; font-family: arial;font-size: 13px;line-height: 22px;padding-left: 9px;text-align: justify;"> Message: </span> <span style="color:#6A5C65; font-size: 12px; line-height:18px; font-family:sans-serif;">'.$message.'</span><br/>
										<span style="color:#6A5C65;     padding-left: 9px; font-size: 12px; line-height:18px; font-family:sans-serif;">To respond to this email click <a href="mailto:'.$senderEmail.'?Subject=Re: SellAtWork.com : Buyer from '.ucfirst($Sender_company_name).' has a message about your listing" target="_top" style="text-decoration:none; color:#5FADD9;">Here</a></span>
										</div>
									</div>											 
								</div>
							<p style="text-align:center;  font-family:sans-serif; padding-top:5px; font-size:18px; text-decoration:underline; color:#5FADD9;">SellAtWork.com</p>
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
					$mail->Port = 587;               
					$mail->setFrom('support@sellatwork.com', 'SellatWork');
					$mail->addAddress($receiverEmail, '');     // Add a recipient
					//$mail->addCC('');
					//$mail->addBCC('');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'SellAtWork.com: Buyer from '.ucfirst($Sender_company_name).' has a message about your listing';
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
			else
			{
				$json = array("status" => 1, "msg" => "Your Message will de delivered shortly on approval.","emailError"=>"");
			}
		}
		else
		{
			$json = array("status" => 0, "msg" => "User not Found","emailError"=>"");
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