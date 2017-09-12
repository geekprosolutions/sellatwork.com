<?php 
include "../backpages/connection.php";
include "../backpages/timeago.php";
if(isset($_SESSION['session_admin_web']['valid']) && $_SESSION['session_admin_web']['valid']==true)
{
	$sql_query1=mysqli_query($conn,"select * from message_box where approval_status='Not Approved'   order by message_id desc");
	$result_rows=mysqli_num_rows($sql_query1);
	if($result_rows==0)
	{
		$json = array("status" => 0, "msg" => "Sorry! No Messages found"); 
	}
	else
	{
		while($result=mysqli_fetch_assoc($sql_query1))
		{
			$userinfo['message_id']=$result['message_id']; // Original Message Id
			//Receiver Info 
			$receiver_query=mysqli_query($conn,"select * from users where user_id='".$result['receiver_id']."' ");
			$receiver_query_result=mysqli_fetch_array($receiver_query);
			$userinfo['receiver_name']=$receiver_query_result['username']; // Person name Who Had Sent Request
			$userinfo['receiver_email']=$receiver_query_result['email'];
			
			$userinfo['receiver_id']=$result['receiver_id']; // Product Owner Id 
			$userinfo['product_id']=$result['product_id']; // Product Requested for
			
			// product Info
			$sql_query2=mysqli_query($conn,"select * from products where product_id='".$result['product_id']."' ");
			$result2=mysqli_fetch_array($sql_query2);
			$userinfo['product_title']=$result2['title'];
			$userinfo['product_price']=$result2['price'];
			$userinfo['product_category']=$result2['category'];
			$userinfo['product_image']=$result2['pro_image'];
			$userinfo['product_uploadOn']=$result2['upload_on'];
			
			// Person Info Who had sent Request For Product
			$userinfo['sender_email']=$result['sender_email']; // Person's email Who Had Sent Request
			$userinfo['sender_id']=$result['sender_id']; // Person Who Had sent Message / Request 
			$sql_query3=mysqli_query($conn,"select * from users where user_id='".$result['sender_id']."' ");
			$result3=mysqli_fetch_array($sql_query3);
			$userinfo['sender_name']=$result3['username']; // Person name Who Had Sent Request
			$userinfo['sender_company_name']=$result3['company_name'];
			$userinfo['sender_country']=$result3['country'];
			$userinfo['sender_state']=$result3['state'];
			$userinfo['sender_city']=$result3['city'];
			$userinfo['sender_location']=$result3['location'];
			
			
			$userinfo['message']=$result['message']; // Message Sent By the Person
			$userinfo['sent_on']=$result['sent_on']; // Message Sent on Date
			$array[]=$userinfo;
		}
		if($result_rows==1){ $result_found="message found"; } else{ $result_found="messages were found in your Inbox"; }
		$json = array("status" => 1, "msg" => "<b> $result_rows </b> $result_found ","rows"=>$result_rows,$array);
	}
	
}
else
{
	header('Refresh:1;url='.$url_root.'/admin/login.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait...";
	die;
}

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
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="../css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style --> 
<link href="../css/ken-burns.css" rel="stylesheet" type="text/css" media="all" /> <!-- banner slider --> 
<link href="../css/animate.min.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="styles.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="../css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->
<link href="../css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="../css/jquery_ui.css">  
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
<script src="../js/jquery-2.2.3.min.js"></script> 
<script src="../js/range_slider/jquery_ui.js"></script>
<script src="../js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="../css/alertify/alertify.min.css"/>		 

  
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
		
		<div class="clear"></div>
		<div id="inbox">    
		 	<div class="Prod_wrape" id="mylist">
				 <?php 
					if($json['status']==0)
					{
						echo '<div class="info512"><h1 class="result_found"> Sorry! No Result Found </h1> </div>'; 
					}
					
					elseif($json['status']==1)
					{
						echo '<div class="Prod_head1">
								<h1 class="serach">'.$json['msg'].'</h1>
								<div class="back"><a href="adminPanel.php"> << Home </a></div>
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
											 <a href="#">
												 <div class="col-lg-2 col-lg-offset-0 col-xs-12 col-xs-offset-0 col-md-2 col-md-offset-0 col-sm-offset-0 col-sm-3   rt_br">
													<img src="'.$product_pic.'" style="width:140px; height:140px;" />  
												</div>
											</a>
											<div class="col-lg-6 col-xs-12 col-md-5 col-sm-offset-0 col-sm-4"> 
												<div class="left">
													<a href=#"><div class="prod_title">'.$json[0][$i]['product_title'].' </div></a>												
														<div class="email"> Sender Email: '.$json[0][$i]['sender_email'].' </div>
														<div class="email"> Receiver Email: '.$json[0][$i]['receiver_email'].' </div>
														<div > Sender Location: '.$json[0][$i]['sender_location'].' </div>
														<div style="color:#555; font-size: 13px; margin-top:3px;"> Message   </div> 
														<div class="msg"> '.$json[0][$i]['message'].' </div> 
														<div class="upload">Sent On :<span style="color:#333;">  '.get_timeago(strtotime($json[0][$i]['sent_on'])).' </span> </div> '; 
															
										echo'</div> 
											</div>
											<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 col-xs-offset-0">
											<div class="right">
												<span>
													<button type="button" class="btn btn-primary" onclick="approveMessages('.$json[0][$i]['message_id'].')">Approve Message</button>
												</span>';
												
												
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
	
	<!-- Loader Begins -->
		<div id="ark_loader" class="ark_loader" style="display:none" >
			<span>
				<span class="innerLdr"><img src="../img/loading.gif" style="height:150px" ></span>
			</span>
		</div>
	<!-- Loader Ends -->							 
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
function approveMessages(msgid)
{	
	$("#ark_loader").css("display","block");
	var data ={"Action":"approveMessage","message_id" : msgid};
	$.ajax
	({
		url : 'handleRequests.php',
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
						location.reload(true);
						bootbox.hideAll();
					}, 2000);
			}
		}
	});
}
</script>