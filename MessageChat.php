<?php 
include "backpages/connection.php";
include "backpages/timeago.php";
include "backpages/messageChat.php";
if(!isset($_SESSION['session_web']['valid']) || $_SESSION['session_web']['valid']!=true  )
{
	header('Refresh:1;url='.$url_root.'login.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait... ";
	die;
}
elseif(!isset($_SESSION['session_web']['login_userVerified']) || $_SESSION['session_web']['login_userVerified']!="Verified" || !isset($_SESSION['session_web']['login_userCompanyVerified']) || $_SESSION['session_web']['login_userCompanyVerified']!="Verified")
{	
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Unauthorized Access! Please Verify Your Account. Redirecting Please Wait...";
	die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell at Work Products Inbox </title>
<base href="<?php echo $url_root ; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="SellAtWork,SAW, trusted classifieds, safe, buy from co-workers, selling to peers, social shopping, online deals, classifieds, Buy local stuff, Local stuff for sale, Local shopping, Local marketplace, Local yard sales, Local garage sales, Sell locally, Buy locally, Sell stuff at Work, trusted network, no worry buy and sell" />
<!-- Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style --> 
<link href="css/ken-burns.css" rel="stylesheet" type="text/css" media="all" /> <!-- banner slider --> 
<link href="css/animate.min.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/jquery_ui.css">  
<!-- web-fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lovers+Quarrel" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Offside" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Tangerine:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- web-fonts --> 

<!-- js --><link rel="icon" type="image/png" href="favicon.ico">
<script src="js/jquery-2.2.3.min.js"></script> 
<script src="js/range_slider/jquery_ui.js"></script>
<script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="css/alertify/alertify.min.css"/>		 

  
 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

 
</head>
<body>
<div id="My_conatiner" style="background-color:#fff;"> 
<!-- Header starts -->
<?php include "header.php" ;?>
<!--Header Ends -->		 
		  <div class="margin_top pd_mob" ></div>

		<div class="clear"></div>
		
	<div id="inbox"> 
		 	<div class="Prod_wrape">
			<?php 
				$status=$json['status'];
				echo "<input type='hidden' value='".$json['original_message_receiver_id']."' id='original_message_receiver_id' >";
				echo "<input type='hidden' value='".$json['original_message_sender_id']."' id='original_message_sender_id' >";
				if($status==0) // No Reply yet
				{
					$images=explode(",",$json['product_image']);
					foreach($images as $image)
					{
						if($image!="" || $image!=" ")
						{
							$product_pic=$image;
						}
					}
					
					
					echo '<div class="Prod_head1">
							<h1 class="serach">'.$json['msg'].' </h1>
							<div class="back"><a href="index.php"> << Home </a></div>
						 </div>
						 <div class="Prod_des">
							<div class="wraper"> 
								<div class="inbox_wrape">
									<div class="col-lg-2 col-lg-offset-0 col-xs-12 col-xs-offset-0 col-md-2 col-md-offset-0 col-sm-offset-0 col-sm-3   rt_br">
										<a href="ViewAd/'.$product_id.' "><img src="'.$product_pic.'" style="width:140px; height:140px;" />  </a>
									</div>
									<div class="col-lg-7 col-xs-12 col-md-6 col-sm-offset-0 col-sm-5"> 
										<div class="left">
											<a href="ViewAd/'.$product_id.' "><div class="prod_title">'.$json['product_title'].' </div></a>												
											   
													<div class="email"> <i class="material-icons">email</i> '.$json['msg_sender_email'].' </div>
													
													<div class="upload"> Uploaded On:  
													 <span style="color:#333;">'.$json['product_uploadOn'].'</span>
													   </div>  				
													<div style="color:#555; font-size: 13px; margin-top:3px;"> Message   </div> 
													<div class="msg"> '.$json['original_message'].' </div> </div> 
													<div class="upload"> Sent On :<span style="color:#333;">  '.get_timeago(strtotime($json['original_message_date'])).' </span> </div>  
									</div>
									
									<div class="reply col-lg-7">
										 <div class="reply1" >
											<i class="material-icons">reply</i> 
										 </div>
										  <div class="replydiv6">
												<textarea style="width:100%;"  placeholder="Reply Here.."></textarea>
												
												<button type="button" class="defaultbtn replybtn" style="float:right;">Send</button> 
												<input type="hidden" name="msgId" value="'.$json['original_message_id'].'" >
										 </div>
								   </div>																		 
								</div>
							</div>		  
						</div>';
						 
						 
						 
				}
				
				elseif($status==1) // Some Result Found
				{
					$images=explode(",",$json['product_image']);
					foreach($images as $image)
					{
						if($image!="" || $image!=" ")
						{
							$product_pic=$image;
						}
					}
					
					echo '<div class="Prod_head1">
							<h1 class="serach">'.$json['msg'].' </h1>
							<div class="back"><a href="index.php"> << Home </a></div>
						 </div>
						 <div class="Prod_des">
							<div class="wraper">
								<div class="inbox_wrape">
									<div class="col-lg-2 col-lg-offset-0 col-xs-12 col-xs-offset-0 col-md-2 col-md-offset-0 col-sm-offset-0 col-sm-3   rt_br">
										<a href="ViewAd/'.$product_id.' "><img src="'.$product_pic.'" style="width:140px; height:140px;" />  </a>
									</div>
									<div class="col-lg-7 col-xs-12 col-md-6 col-sm-offset-0 col-sm-5"> 
										<div class="left">
											<a href="ViewAd/'.$product_id.' "><div class="prod_title">'.$json['product_title'].' </div></a>												
													<div class="email"> <i class="material-icons">email</i> '.$json['msg_sender_email'].' </div>
													
													<div class="upload"> Uploaded On:  
													 <span style="color:#333;">'.$json['product_uploadOn'].'</span>
													 , Sent On :<span style="color:#333;">  '.$json['original_message_date'].' </span> </div>  				
													<div style="color:#555; font-size: 13px; margin-top:3px;"> Message   </div> 
													<div class="msg"> '.$json['original_message'].' </div> </div> 
									</div>
									
									<div class="reply col-lg-7">
										<div class="reply1" >
											<i class="material-icons">reply</i> 
										 </div>
										  <div class="replydiv6">
												<textarea style="width:100%;"  placeholder="Reply Here.."></textarea>
												<button type="button" style="float:right;" class="defaultbtn replybtn"  >Send</button>
												<input type="hidden" name="msgId" value="'.$json['original_message_id'].'" >
										 </div>
								   </div></div>';
								   echo'<div id="Message_section">';
								    for($i=0;$i<count($json[0]);$i++)
									{
										
											if($json[0][$i]['product_owner_reply']!="")
											{
												// Owner reply
												echo '
											
												 
													<div class="owner">
													  <img src="'.$json[0][$i]['product_owner_photo'].'" alt=""/>
														  <div class="replydiv6"> 
															<div class="msg">
																'.$json[0][$i]['product_owner_reply'].'
															</div>
															<div style="color:#555; font-size: 13px; margin-top:3px;">
																	SentOn : '.$json[0][$i]['product_owner_reply_time'].'
															</div>
														 </div>
												   </div>
												 ';
											}
											else
											{
												// Other Person Reply
												echo '
														<div class="other">	
															<img src="'.$json[0][$i]['request_user_photo'].'" alt=""/>
															<div class="replydiv6">
																<div class="msg">
																	'.$json[0][$i]['request_user_reply'].'
																</div>
																<div style="color:#555; font-size: 13px; margin-top:3px;">
																SentOn : '.$json[0][$i]['request_user_reply_time'].'</div>
															</div>
														</div>
												  ';
											   
											}
										
									}
								   
								   
								echo'</div>			  
								</div>			  
							</div>		  
						</div>';
						 
						 
				}
			?>
	</div>	  
 </div>
 
	
	
 
	<!--=======Head  end=======-->
  <div class="clear"></div>
  <!-- Footer Begins-->
	<?php include "footer.php" ; ?>
	<!-- Footer Ends -->
	
	
	<!-- Loader Begins -->
		<div id="ark_loader" class="ark_loader" style="display:none" >
			<span>
				<span class="innerLdr"><img src="img/loading.gif" style="height:150px" ></span>
			</span>
		</div>
	<!-- Loader Ends -->

</body>
</html>

<script>
// Send Message 
$(".replybtn").on("click",function(e)
{
	e.preventDefault();
	$("#ark_loader").css("display","block");
	var messageId=$(this).next("input").val();
	var message=$(this).prev("textarea").val();
	var original_message_sender_id=$("#original_message_sender_id").val();
	var original_message_receiver_id=$("#original_message_receiver_id").val();
	var data=
	{
		"message_id" :  messageId,
		"message" :  message,
		"original_message_receiver_id" :  original_message_receiver_id,
		"original_message_sender_id" :  original_message_sender_id,
		"action" : "reply",
	};

	
	$.ajax
	({
		url:"backpages/RequestHandling.php",
		type: "POST",
		data: data,
		success: function(response)
		{
			//alert(JSON.stringify(response));
			if(response.status==0)
			{
				bootbox.dialog({
				message: '<p class="text-center">'+response.msg+'</p>',
				closeButton: false
				});
				setTimeout(function() {
						$("#ark_loader").css("display","none");
						bootbox.hideAll();	
					}, 2000);
			}
			else
			{
				$('#myModal').modal('hide');
				bootbox.dialog({
				message: '<p class="text-center">'+response.msg+'</p>',
				closeButton: false
				});
				setTimeout(function() {
						location.reload(true);
						bootbox.hideAll();	
					}, 2000);
					
			}
		}
	});
});

</script>

<!-- *************** Location Finder *************** -->
<script src="UserLocationScript.js"> </script>
<!-- *************** Location Finder  *************** -->


