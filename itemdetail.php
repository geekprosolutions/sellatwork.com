<?php
include "backpages/connection.php";
include "backpages/timeago.php";
include "backpages/product_details.php";
include "backpages/makeLinks.php";
$product_images=explode(",",$json[0]['product_pro_image']);
$image=$product_images[0];
$title= $json[0]['product_title'];
$description= $json[0]['product_description'];
$page_url= "https://www.sellatwork.com/ViewAd/$productId";

$price =  $json[0]['product_price'];
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
	$price = "$ ". $json[0]['product_price'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $json[0]['product_title']. " | ". $price." | SellAtWork.com -". $json[0]['product_category']; ?></title>
<base href="<?php echo $url_root ; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:url"         content="<?php echo $page_url ;?>" />
<meta property="og:type"        content="article" />
<meta property="og:title"       content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $description;?>" />
<meta property="og:image"       content="<?php echo $image ;?>" />
<meta property="og:image:300px;"/>
<meta property="og:image:300px;"/>
<meta property="fb:app_id"      content="246439162441225" />

<meta name="keywords" content="SellAtWork,SAW, trusted classifieds, safe, buy from co-workers, selling to peers, social shopping, online deals, classifieds, Buy local stuff, Local stuff for sale, Local shopping, Local marketplace, Local yard sales, Local garage sales, Sell locally, Buy locally, Sell stuff at Work, trusted network, no worry buy and sell" />
<!-- Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style -->
<link href="css/ken-burns.css" rel="stylesheet" type="text/css" media="all" /> <!-- banner slider -->
<link href="css/animate.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->
<!-- web-fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lovers+Quarrel" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Offside" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Tangerine:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
<!-- web-fonts -->
 <link rel="icon" type="image/png" href="favicon.ico">
<!-- js -->
<script src="js/jquery-2.2.3.min.js"></script>
<!--slider links-->
    <link href="css/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="js/js-image-slider.js" type="text/javascript"></script>
    <link href="css/tooltip.css" rel="stylesheet" type="text/css" />
    <script src="js/tooltip.js" type="text/javascript"></script>
	

<!-- //js -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
 <!--range slider-->
<!-- //font-awesome icons -->
<link rel="stylesheet" href="css/jquery_ui.css">
	<script src="js/range_slider/jquery_ui.js"></script>
	<script src="js/owl.carousel.js"></script>

<script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>

<!-- start-smooth-scrolling -->

<script src="js/bootstrap.js"></script>

<!-- **************************** Alertify **************************** -->
<script src="js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="css/alertify/alertify.min.css"/>
<!-- **************************** Alertify Ends **************************** -->
<script  type="text/javascript" src="js/Slider.js"></script>
<script type="text/javascript" src="js/jssor.js"></script>
<script type="text/javascript" src="js/jssor.slider.js"></script>

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

			 <div id="single_items" style="margin:auto auto 0em;padding-bottom:1em;">
				<div class="wrape">
				<div class="col-lg-6  signle_q">
				<!--<div class="alert_msg">
					<i class="material-icons">account_box</i> <a href="signup.php">Register </a>or <a href="login.php">Login</a> to contact the seller.
				 </div> -->
				<?php
					$status=$json['status'];
					if($status==0)
					{
						echo "<div class='Nodata'><h2 class='No_res_tab'>  Sorry! No Products Found In Database </b></div>";
					}
					else
					{
						$price =  $json[0]['product_price'];
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
							$price = "$ ". $json[0]['product_price'];
						}
				?>

					<div class="item_inform">
							<h2><?php echo $json[0]['product_title'] ;?>  - Price : <?php echo $price ;?>
							<span class="time">
							  <?php //echo get_timeago(strtotime($json[0]['product_upload_on'])) ;?>
							 </span>

							  <span class="shop ryt">

								<?php 
								if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
								{
									if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Verified")
									{
										if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Verified")
										{
											if($json[0]['product_user_id']==$_SESSION['session_web']['login_userId'])
											{
												echo'<div class="div1" style=" margin-left: 1%;">
														<i class="material-icons" aria-hidden="true" data-toggle="modal" data-target="#myModal2">person_outline</i>
													</div>';
											}
											else
											{
												echo'<div class="div1"  style="margin-left: 1%;">
												<input type="hidden" value="'.$json[0]['product_user_id'] .'-'.$json[0]['product_id'].'" >
													<i class="material-icons popup" aria-hidden="true" >message</i>
													<input type="hidden" value="'.$json[0]['product_username'] .'">
												</div>';
											}
										}
										else
										{
											echo'<i class="material-icons" aria-hidden="true" onclick="CompanyVerification()">message</i> ';
										}
									}
									else
									{
										echo'<i class="material-icons" aria-hidden="true" onclick="AccountVerification()">message</i>';
									}
								}
								else
								{
									echo'<div class="div1" style="margin-left: 1%;">
											<i class="material-icons" aria-hidden="true" onclick="checkLogin()">message</i>
										</div>';
								}
								?>

							</span>

							</h2>

							<div class="comp"> Seller  work at
										<span>
										<?php echo '<a href="backpages/getitems.php?key=company&e='.$json[0]['product_user_company_name'] .' "> <i class="material-icons">business</i>'.$json[0]['product_user_company_name'].''; ?>
										</span>
							 </div>
  
								<div id="slider1_container"  class="iten_detail_img1" style="position: relative; top: 0px; left: 0px; width: 644px; height: 350px; overflow: hidden; ">
									<!-- Loading Screen -->
									<div u="loading" style="position: absolute; top: 0px; left: 0px;">
										<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
											background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
										</div>
										<div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
											top: 0px; left: 0px;width: 100%;height:100%;">
										</div>
									</div>

									<!-- Slides Container -->
									<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 644px; height: 350px;
										overflow: hidden;">
										<div>
											<div id="sliderh1_container" class="sliderh1" style="position: relative; top: 0px; left: 0px; width: 644px;
												height: 300px;">
												<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width:644px; height: 350px;
													overflow: hidden;">
													<?php
														$images=explode(",",$json[0]['product_pro_image']);
														$total_images=count($images);
														foreach($images as $image)
														{
															
															if($image!="" || $image!=" ")
															{
																echo "<div><a class='example-image-link' href='".$image."' data-lightbox='example-1'>
																<img u='image' class='auto_wdth' src='".$image."' /></a></div>";
															}
														}
													?> 
												</div>
												<div u="navigator" class="jssorb03" style="bottom:-42px; right: 10px;">
													<div u="prototype"><div u="numbertemplate"></div></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								
							</div>
							<!--<img src="<?php echo $json[0]['product_pro_image'] ;?>" alt=""/>-->
							 <div class="clear"></div>
							<div class="desc">
								<h2>Description:</h2>
								<p>
								<?php 
									//echo $json[0]['product_description'] ;
									$str = $json[0]['product_description'];
									makeLinks($str);
								?>
								</p>
							</div>

							<div class="price_section">
								<div class="prc col-lg-7">
								<span>Category :</span> <?php echo $json[0]['product_category'] ;?>
									<div class="addr">
										 <span>Location:</span>
										<?php echo '<a href="backpages/getitems.php?key=location&e='.$json[0]['product_location'].' "><i class="material-icons">location_on</i>'.$json[0]['product_location'].'</a>'; ?>
									</div>
								</div>
							</div>

							<div class="clear"></div>

					</div>

				<?php
					}
				?>
				</div>

				<div class="col-lg-5 item_q">
				<div class="Item_map" style="border: 3px groove #ddd;">
					<div id="map" style="width:600;min-height:380px;"> </div>
				</div>
				<div class="clear"></div>
				<div class="share"><div class="share_txt">Share on</div>
				<?php
					$title=urlencode($json[0]['product_title']);
					$url=urlencode("https://sellatwork.com/");
					$summary=urlencode('');
					$image=urlencode($image);
				?>
					
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $page_url; ?>&t=<?php echo $title;?>"
					   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
					   target="_blank" title="Share on Facebook"><div class="share_ico"> <i class="fa fa-facebook" aria-hidden="true"></i></div>
					</a>

					<a href="https://twitter.com/intent/tweet?url=<?php echo $page_url;?>&amp;text=<?php echo urlencode($json[0]['product_title']) ; ?>&amp;via=sellatwork" target="_blank"><div class="share_ico"><i class="fa fa-twitter" aria-hidden="true"></i></div></a>
					
					<a href="https://plus.google.com/share?url=<?php echo $page_url;?>" target="_blank"><div class="share_ico"><i class="fa fa-google-plus" aria-hidden="true"></i></div>
					</a>
				</div>
				</div>
			 </div>
			 <div class="clear"></div>
			 <div class="col-md-12 single_similer">
				<h2>Similar Products Under This Category</h2>
				<div class="row prodcts">
					<?php
					$status=$json[1]['status'];
					if($status==0)
					{
						echo "<div class='no_same_itm'> No Other Items Found  </div>";
					}
					else
					{
						for($i=0;$i<count($json[1])-2;$i++)
						{
							$images=explode(",",$json[1][$i]['product_pro_image']);
							foreach($images as $image)
							{
								if($image!="" || $image!=" ")
								{
									$product_pic=$image;
								}
							}
							$price =  $json[1][$i]['product_price'];
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
								$price = "$ ". $json[1][$i]['product_price'];
							}
							echo'<div class="item  col-xs-12 col-md-6 col-sm-6 col-lg-3">
									<div class="thumbnail">
										<div class="prod_img3">
											<a href="ViewAd/'.$json[1][$i]['product_id'].'">
											<img class="item_img1" src="'.$product_pic.'" alt=""></a>
										</div>
									
										<div class="caption2">
											<div class="prod_h4">	
												<h4>
													'.$json[1][$i]['product_title'] .'
												</h4>
											</div>
											<div class="prod_prc">
												 '.$price.'
											</div>
										 
										 
											<div class="prod_likes">
												<div class="prod_adderess">
													<div class="location_dv">
														<a href="backpages/getitems.php?key=location&e='.$json[1][$i]["product_location"].' "><i class="material-icons">location_on</i>
														'.$json[1][$i]["product_location"].'</a>
													 </div>
													 
													<div class="prod_compny"> 
													<a href="backpages/getitems.php?key=company&e='.$json[1][$i]["product_user_company_name"].' "> <i class="material-icons">business</i>
													 '. $json[1][$i]["product_user_company_name"].' </a> 
													 </div>
												</div>
												
												<div class="prod_right_msg">';
												if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
												{
													if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Verified")
													{
														if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Verified")
														{
															if($json[1][$i]['product_user_id']==$_SESSION['session_web']['login_userId'])
															{
																echo' <i class="material-icons" aria-hidden="true" data-toggle="modal" data-target="#myModal2">person_outline</i>';
															}
															else
															{
																echo' <input type="hidden" value="'.$json[1][$i]['product_user_id'] .'-'.$json[1][$i]['product_id'].'" >
																	<i class="material-icons popup" aria-hidden="true" >message</i>
																	<input type="hidden" value="'.$json[1][$i]['product_username'] .'">';
															}
														}
														else
														{
															echo'<i class="material-icons" aria-hidden="true" onclick="CompanyVerification()">message</i>';
														}
													}
													else
													{
														echo'<i class="material-icons" aria-hidden="true" onclick="AccountVerification()">message</i>';
													}
												}
												else
												{
													echo' 
															<i class="material-icons" aria-hidden="true" onclick="checkLogin()">message</i>
														 ';
												}
											echo'</div>
											</div>
										 
									</div>
								</div>
							</div>';
						}
					}
				?>
				</div>
			 </div>
			 <!-- ===== Popup Model ===== -->
			<div id="myModal" class="modal fade" role="dialog" >
			<form action="" method="post" id="sendMessage">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> Send Message To <span style="color:#72d576; font-weight:bold;" id="receiverName"> User </span> </h4>
					<input type="hidden" name="receiverId" id="receiverId" >
				  </div>
				  <div class="modal-body">
					<p><button type="button" class="btn quickmessage" id="msg_btn1" value="I'm interested! ">I'm interested! </button>
					<button type="button" class="btn quickmessage" id="msg_btn2">Is this still available? </button>
					<button type="button" class="btn quickmessage" id="msg_btn3">Is the price negotiable ?  </button></p>
					<br />
					<div class="group">
						<?php 
							if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
							{ 
								$useremail=$_SESSION['session_web']['login_userEmail'];
							}
							else
							{
								$useremail="";
							}
						?>
						<input type="text" class="form_text" name="email" value="<?php echo $useremail;?>" required id="e_mail" >
						  <span class="highlight"></span>
						<label>Your Email </label>
						<span id="emailError" class="error"></span>
					</div>

					<br />
					<div class="group">
						<input type="text" class="form_text" name="message" id="messageBox" required >
						  <span class="highlight"></span>
						<label> Your Message  </label>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="Submit" class="apply_btn" >Send</button>
				  </div>
				</div>
			  </div>
			  </form>
			</div>
			<!-- ===== Popup Model Ends ===== -->

			<!-- ===== Popup Model 2 ===== -->
			<div id="myModal2" class="modal fade" role="dialog" >
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> Message </h4>
				  </div>
				  <div class="modal-body">
						This Product Has been Uploaded by you.
				  </div>
				  <div class="modal-footer">
				<button type="button"  style="width:90px; float:right;" class="apply_btn" class="close" data-dismiss="modal" >Close</button>
				  </div>
				</div>
			  </div>
			  </form>
			</div>
			<!-- ===== Popup Model 2 Ends ===== -->

			<div class="clear"></div>

</div>
	<!-- Footer Begins-->
	<?php include "footer.php" ; ?>
	<!-- Footer Ends -->

		<!-- Loader Begins -->
		<div id="ark_loader" class="ark_loader" style="display:none"  >
			<span>
				<span class="innerLdr"><img src="img/loading.gif" style="height:150px" ></span>
			</span>
		</div>
	<!-- Loader Ends -->

</body>
</html>

 <!-- *************** Location Finder *************** -->
<script src="UserLocationScript.js"> </script>
<!-- *************** Location Finder  *************** -->
<script type="text/javascript">
$(document).ready(function()
{
    var mapCenter = new google.maps.LatLng(22.000, 78.000); //Google map Coordinates
	var map;

			var lat= <?php echo $json[0]['product_user_latitude'] ; ?>;
			var lng= <?php echo $json[0]['product_user_longitude'] ; ?>;
			var marker,i;

				var myOptions =
				{
					zoom: 12,
					minZoom: 5,
					draggable: false,
					scrollwheel: true, // disable Zoom On Scroll Wheel
					disableDoubleClickZoom: true, //Disable double click
					center: new google.maps.LatLng(lat,lng), // Center of the map
					scaleControl: true, // Bottom Scale Controls
					disableDefaultUI: false,
					mapTypeControl: false, // Map Type ( Road, Styled Map ) At Top Left
					zoomControl: true, // Zoom Buttons Bu Default
					zoomControlOptions: {
					position: google.maps.ControlPosition.RIGHT_BOTTOM
					},
					streetViewControl: true,
					streetViewControlOptions: {
					position: google.maps.ControlPosition.RIGHT_BOTTOM
					}
				};
				var infowindow = new google.maps.InfoWindow();

				map = new google.maps.Map(document.getElementById("map"),myOptions);
				marker= new google.maps.Marker
				({
					position: new google.maps.LatLng(lat,lng),
					map: map,
					icon: "images/mapIcon.png",
				});

			  var contenthtml= "User Location";
			  google.maps.event.addListener(marker, 'click', (function(map,marker)
			  {
				return function()
				{
				  infowindow.setContent(contenthtml);
				  infowindow.open(map,marker);
				}
			  })(map,marker));
			  marker.setAnimation(google.maps.Animation.BOUNCE);
			  google.maps.event.addListener(map, "click", function(event) {
				infowindow.close();
			  });

	});
</script>
<script>
$(document).ready(function()
{
	$(".popup").click(function()
	{
		var receiver_product_Id=$(this).prev("input").val();
		var receiverName=$(this).next("input").val();

		$("#receiverId").val(receiver_product_Id);
		$("#receiverName").html(receiverName);

		var data=
		{
			"request" : receiver_product_Id,
			"action" : "getDetail",
		}
		
		$.ajax
		({
			url: 'backpages/checkRequest.php',
			type : "post",
			data : data,
			success :function(response)
			{
				//alert(JSON.stringify(response));
				if(response.status==0)
				{
					$('#myModal').modal('show');
					popup();
				}
				else
				{
					window.location.href="Chat/"+receiver_product_Id;
				}
			}
		});

	});

	//Send Message
	function popup()
	{
		$("#msg_btn1").click(function()
		{
			var msg=$(this).html();
			$("#messageBox").val(msg);
		});
		$("#msg_btn2").click(function()
		{
			var msg=$(this).html();
			$("#messageBox").val(msg);
		});
		$("#msg_btn3").click(function()
		{
			var msg=$(this).html();
			$("#messageBox").val(msg);
		});

		// Send Message
		$("#sendMessage").on("submit",function(e)
		{
			e.preventDefault();
			$('#myModal').modal('hide');
			$("#ark_loader").css("display","block");
			$("#ark_loader").css("z-index","1050");
			
			
			var receiverId=$("#receiverId").val();
			var email=$("#e_mail").val();
			var message=$("#messageBox").val();

			var jsonObj=
			{
				"receiverId" : receiverId,
				"email" : email,
				"message" : message,
			};
			var data=JSON.stringify(jsonObj);
			$.ajax
			({
				url:"backpages/send_productRequest.php",
				type: "POST",
				data: data,
				success: function(response)
				{
					//alert(JSON.stringify(response));
					if(response.status==0)
					{
						//$("#ark_loader").css("display","none");
						$("#emailError").html(response.emailError);
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
						$('#sendMessage').trigger("reset");
						$("#emailError").html(response.emailError);
												
						bootbox.dialog({
						message: '<p class="text-center">'+response.msg+'</p>',
						closeButton: false
						});
						setTimeout(function() {
							   $("#ark_loader").css("display","none");
								bootbox.hideAll();
							}, 2000);
					}
				}
			});
		});

	}

});
</script>
