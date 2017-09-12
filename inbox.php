<?php 
include "backpages/connection.php";
include "backpages/timeago.php";
include "backpages/myinbox.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell at Work Products Inbox </title>
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

<link rel="icon" type="image/png" href="favicon.ico">
<!-- js -->
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
		<div class="margin_top" style="padding-top:3em;"></div>
		<?php 
		 if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
			  {
				  if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Not Verified")
				  {
					echo'<div class="col-md-12" style="background-color: #f06966;min-height:30px;max-height:65px;">
							<span style="font-weight: normal;font-family:Rubik,sans-serif !important;color: #454545;font-size:15px;line-height:30px; ">
								<center> Please Check Your Mail to Verify Your Account </center>
							</span>
					   </div>';
				  }
				  else
				  {
					  if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Not Verified")
					  {
						  echo'<div class="col-md-12" style="background-color: #f06966;min-height:30px;max-height:65px;">
									<span style="font-weight: normal;font-family:Rubik,sans-serif !important;color: #454545;font-size:15px;line-height:30px; ">
										<center> Please <a href="verification.php" style="color:white">Verify </a> Your Company to post an Ad or Contact anyone.  </center>
									</span>
							   </div>';
					  }
				  }
			  }  
		?>
		
		<div class="clear"></div>
		
	<div id="inbox"> 
		 	<div class="Prod_wrape">
			<?php 
				$status=$json['status'];
				if($status==0) // No Result 
				{
					echo '<div class="info512"><h1 class="result_found"> Sorry! No Result Found </h1> </div>'; 
				}
				
				elseif($status==1) // Some Result Found
				{
					echo '<div class="Prod_head1">
							<h1 class="serach">'.$json['msg'].' </h1>
							<div class="back"><a href="index.php"> << Home </a></div>
						 </div>';
						
			?>
				
				<div class="Prod_des">
				    <div class="wraper">
					  <?php 
							for($i=0;$i<$json['rows'];$i++)
							{
								$images=explode(",",$json[0][$i]['product_image']);
								foreach($images as $image)
								{
									if($image!="" || $image!=" ")
									{
										$product_pic=$image;
									}
								}
								$price = $json[0][$i]['product_price'];
									if($price=="0" || $price=="" || $price=="Not Available")
									{
										$price =" Free ";
									}
									elseif($price=="Best Offer")
									{
										$price =" Best Offer ";
									}
									else
									{
										$price = "$ ".$json[0][$i]['product_price'];
									}	
								echo '	 
										<div class="inbox_wrape">
											 <a href="ViewAd/'.$json[0][$i]['product_id'].'">
												 <div class="col-lg-2 col-lg-offset-0 col-xs-12 col-xs-offset-0 col-md-2 col-md-offset-0 col-sm-offset-0 col-sm-3   rt_br">
													<img src="'.$product_pic.'" style="width:140px; height:140px;" />  
												</div>
											</a>
											<div class="col-lg-6 col-xs-12 col-md-5 col-sm-offset-0 col-sm-4"> 
												<div class="left">
													<a href="ViewAd/'.$json[0][$i]['product_id'].'"><div class="prod_title">'.$json[0][$i]['product_title'].' </div></a>												
													   
															<div class="email"> <i class="material-icons">email</i> '.$json[0][$i]['sender_email'].' </div>
															
															<div class="upload"> Uploaded On:  
															 <span style="color:#333;">'.$json[0][$i]['product_uploadOn'].'</span>
															 </div>  				
															<div style="color:#555; font-size: 13px; margin-top:3px;"> Message   </div> 
															<div class="msg"> '.$json[0][$i]['message'].' </div> 
															<div class="upload">Sent On :<span style="color:#333;">  '.get_timeago(strtotime($json[0][$i]['sent_on'])).' </span> </div> '; 
															
										echo'</div> 
											</div>
											<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-xs-offset-0">
											<div class="right">
												<span class="price1 deleteRequest" onclick="deleteRequest('.$json[0][$i]['message_id'].')">
												<i class="fa fa-trash" style="bottom:0;" aria-hidden="true" data-placement="top" data-toggle="tooltip" title="Delete Product"></i>
												</span>
												<a class="reply_a" href="Chat/'.$json[0][$i]['receiver_id'] .'-'.$json[0][$i]['product_id'].'"> 
												<i class="material-icons" data-placement="top" data-toggle="tooltip" title="reply">reply</i> </a> ';
												
												
										echo '</div>
											<div class="right">
												<span class="price"> '.$price.' </span> 
												<span class="category"><i class="fa fa-tags" aria-hidden="true"></i> 
												'.$json[0][$i]['product_category'].' </span> 
											</div>
											
											 </div> 
										</div>
									 ';
							}
						?>				 
					</div>		  
				</div>
			<?php 
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
// Delete Resquest function

function deleteRequest(message_Id)
{
	if (confirm("Are You Sure you want to Delete This Item?") == true) 
	{
        deleteConfirm(message_Id);
    } 
	else 
	{
       return false;
    }
}
function deleteConfirm(message_Id)
{
	$("#ark_loader").css("display","block");
	var messageId=message_Id;
	var data=
	{
		"message_id" :  messageId,
		"action" : "delete",
	};
	
	$.ajax
	({
		url : 'backpages/RequestHandling.php',
		type : 'post',
		data : data,
		success : function(response)
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
				bootbox.dialog({
				message: '<p class="text-center">'+response.msg+'</p>',
				closeButton: false
				});
				setTimeout(function() {
						window.location.href = "inbox.php";
						bootbox.hideAll();
					}, 2000);
			}
		}
	});
}

</script>
<!-- *************** Location Finder *************** -->
<script src="UserLocationScript.js"> </script>
<!-- *************** Location Finder  *************** -->
