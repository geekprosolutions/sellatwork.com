<?php 
include "backpages/connection.php";
include "backpages/timeago.php";
include "backpages/productlist.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell at Work Products - Trusted, Safe & Easy Transactions </title>
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
<!-- web-fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lovers+Quarrel" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Offside" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Tangerine:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" >
<!-- web-fonts --> 
 <link rel="icon" type="image/png" href="favicon.ico">
<!-- js -->
<script src="js/jquery-2.2.3.min.js"></script> 
<!-- //js --> 
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 

<!-- //font-awesome icons -->
 <!--range slider-->
<link rel="stylesheet" href="css/jquery_ui.css">
	<script src="js/range_slider/jquery_ui.js"></script>
	<script src="js/owl.carousel.js"></script>  
	<script>
$(document).ready(function() { 
	$("#k").owlCarousel({ 
	  autoPlay: 3000, //Set AutoPlay to 3 seconds 
	  items :4,
	  itemsDesktop : [640,5],
	  itemsDesktopSmall : [480,2],
	  navigation : true
 
	}); 
}); 
</script>
<script>
$(document).ready(function() { 
	$("#owl-demo").owlCarousel({ 
	  autoPlay: 3000, //Set AutoPlay to 3 seconds 
	  items :4,
	  itemsDesktop : [640,5],
	  itemsDesktopSmall : [480,2],
	  navigation : true
 
	}); 
}); 
</script>
<script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>


<!-- start-smooth-scrolling -->

<script src="js/bootstrap.js"></script>	

<script>
$(document).ready(function() {
$("#grid").click(function () {
    $("#grid").addClass("color");  
	$("#list").removeClass("active");  
	$("#thumb").removeClass("active");	
}); 
 
});
</script>

<!-- **************************** Alertify **************************** -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<!-- **************************** Alertify Ends **************************** -->
</head>
<body style="background-color:#f5f5f5;">
<div id="My_conatiner" style="background-color:#f5f5f5;"> 
<!-- Header starts -->
<?php include "header.php" ;?>
<!--Header Ends -->	
 
			<div class="margin_top" style="padding-top:3em"></div>			
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
			<!-- Info Tip End -->
			<div class="clear"></div>		
				<div class="Prod_wrape" id="prod_media">
					<div class="well well-sm">
					 
						<div class="btn-group" style="margin-left:0;">
							<a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
							</span>List</a>
							<a href="#" id="thumb" class="btn btn-default btn-sm"><span
								class="glyphicon glyphicon-th"></span>Thumb</a>
								<a href="#" id="grid" class="btn btn-default btn-sm default_select" style="color:red;"><span
								class="glyphicon glyphicon-th"></span>Grid</a>
						</div>					
						<div id="my_tab3">
							<div id="tabs">
							  <ul>
								<?php 
								
								 if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
								 {
									 if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Not Verified")
									 {
										echo'<li><a href="#tabs-1">Recent Adds</a></li>'; 
									 }
									 else
									 {
										echo '<li><a href="#tabs-1">'.$myOffice["company_name"].'</a></li>';
									 }
								 }
								 else
								 {
									echo'<li><a href="#tabs-1">Recent Adds</a></li>';  
								 }
								?>
								<li><a href="#tabs-3" >Around Me</a></li>    
							  </ul>
							 
							 <div id="tabs-1">								
								<div id="products" class="row list-group">
									<?php 
										if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
										{
											if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Not Verified")
											{
												$status=$allAdds['status'];
												if($status==0) // No Products Found
												{
													echo "<div class='Nodata'><h2 class='No_res_tab'>  Sorry! No Products Found In Database </b></div>";
												}
												else
												{											
													for($i=0;$i<count($allAdds[0]);$i++)
													{
														$images=explode(",",$allAdds[0][$i]['pro_image']);
														foreach($images as $image)
														{
															if($image!="" || $image!=" ")
															{
																$product_pic=$image;
															}
														}
														$price = $allAdds[0][$i]['price'];
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
															$price = "$ ".$allAdds[0][$i]['price'];
														}
														echo'<div class="item  col-xs-12 col-md-4 col-sm-4 col-lg-3">
															<div class="thumbnail">
																<div class="prod_img3">
																	<a href="ViewAd/'.$allAdds[0][$i]['product_id'].'">
																	<img class="item_img1" src="'.$product_pic.'" alt=""/></a>
																</div>
																
																<div class="caption2">
																  <div class="prod_h4">
																	<a href="ViewAd/'.$allAdds[0][$i]['product_id'].'">
																		<h4>
																		'.$allAdds[0][$i]['title'] .'</h4>
																	</a>
																	</div>
																 
																	<div class="prod_prc">
																		 <span class="br_thumbv">'.$price .' </span> 
																	</div> 
																	 <div class="prod_likes">
																				<div class="prod_adderess">
																					<div class="location_dv">
																						<a href="backpages/getitems.php?key=location&e='.$allAdds[0][$i]["location"].' "><i 	class="material-icons">location_on</i>
																						'.$allAdds[0][$i]["location"].'</a>
																					</div>
																				   <div class="prod_compny">
																						<a href="backpages/getitems.php?key=company&e='.$allAdds[0][$i]["company_name"].' ">	 <i class="material-icons">business</i>
																						'. $allAdds[0][$i]["company_name"].' </a> 
																					</div>
																				 </div>
																		<div class="prod_right_msg">';
																			 
																			if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
																			{
																				if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Verified")
																				{
																					if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Verified")
																					{
																						if($allAdds[0][$i]['user_id']==$_SESSION['session_web']['login_userId'])
																						{
																							echo' 
																									<i class="material-icons" aria-hidden="true" data-toggle="modal" data-target="#myModal2">person_outline</i> 							 
																								 ';
																						}
																						else
																						{
																						echo' 	
																								<input type="hidden" value="'.$allAdds[0][$i]['user_id'] .'-'.$allAdds[0][$i]['product_id'].'" >
																								<i class="material-icons popup" aria-hidden="true" >message</i> 							 
																								<input type="hidden" value="'.$allAdds[0][$i]['username'] .'">
																							 ';
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
																				echo' 	
																						<i class="material-icons" aria-hidden="true" onclick="checkLogin()">message</i> 							 
																					 ';
																			}
																		echo'</div></div>
																 
																</div>
															</div>
														</div>';	 
													}
												}
											}// Company not verifeid Ends 
											else
											{
												$status=$myOffice['status'];
												if($status==0) // No Products Found
												{
													echo "<div class='Nodata'><h2 class='No_res_tab'> Sorry! No Products Found In Database </h2></div>";
												}
												else
												{
												
													for($i=0;$i<count($myOffice[0]);$i++)
													{
														$images=explode(",",$myOffice[0][$i]['pro_image']);
														foreach($images as $image)
														{
															if($image!="" || $image!=" ")
															{
																$product_pic=$image;
															}
														}
														$price = $myOffice[0][$i]['price'];
														
														if($price=="0" || $price=="" || $price=="Not Available" )
														{
															$price =" Free ";
														}
														elseif($price=="Best Offer")
														{
															$price =" Best Offer ";
														}
														else
														{
															$price = "$ ".$myOffice[0][$i]['price'];
														}
															
														echo '<div class="item  col-xs-12 col-md-4 col-sm-4 col-lg-3">
																	<div class="thumbnail">
																		<div class="prod_img3">
																			<a href="ViewAd/'.$myOffice[0][$i]['product_id'].'">
																			<img class="item_img1" src="'.$product_pic.'" alt=""  /></a>
																		</div>
																		
																		<div class="caption2">
																			<div class="prod_h4">
																				<a href="ViewAd/'.$myOffice[0][$i]['product_id'].'">
																					<h4>
																					'.$myOffice[0][$i]['title'] .'</h4>
																					</a>
																			</div>
																			
																			<div class="prod_prc"> 
																						 <span class="br_thumbv">'.$price .' </span> 
																			</div>
																			
																			<div>
																				<div class="prod_likes">
																					<div class="prod_adderess">	 
																						<div class="location_dv">
																							<a href="backpages/getitems.php?key=location&e='.$myOffice[0][$i]["location"].' ">		<i class="material-icons">location_on</i>
																								'.$myOffice[0][$i]["location"].' </a>
																						</div>
																						 <div class="prod_compny"> 
																							<a href="backpages/getitems.php?key=company&e='.$myOffice[0][$i]["company_name"].' ">		 <i class="material-icons">business</i>
																							  '. $myOffice[0][$i]["company_name"].'</a>
																						</div>
																					 </div> 
																					 <div class="prod_right_msg">';
																							if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
																							{
																								if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Verified")
																								{
																									if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Verified")
																									{
																										if($allAdds[0][$i]['user_id']==$_SESSION['session_web']['login_userId'])
																										{
																											echo' 	
																													<i class="material-icons" aria-hidden="true" data-toggle="modal" data-target="#myModal2">person_outline</i>							 
																												 ';
																										}
																										else
																										{
																											echo' 
																													<input type="hidden" value="'.$myOffice[0][$i]['user_id'].'-'.$myOffice[0][$i]['product_id'].'">
																													<i class="material-icons popup" aria-hidden="true" >message</i>
																													<input type="hidden" value="'.$myOffice[0][$i]['username'] .'">
																												 ';
																										}
																									}
																									else
																									{
																										echo' 
																										<i class="material-icons" aria-hidden="true" onclick="CompanyVerification()">message</i> 							 
																										';
																									}
																								}
																								else
																								{
																									echo' 
																										<i class="material-icons" aria-hidden="true" onclick="AccountVerification()">message</i> 							 
																									 ';
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
																	</div>
																</div>';
														 
														}
													}
										
											}
										}
										else
										{
											$status=$allAdds['status'];
											if($status==0) // No Products Found
											{
												echo "<div class='Nodata'><h2 class='No_res_tab'>  Sorry! No Products Found In Database </b></div>";
											}
											else
											{											
												for($i=0;$i<count($allAdds[0]);$i++)
												{
													$images=explode(",",$allAdds[0][$i]['pro_image']);
													foreach($images as $image)
													{
														if($image!="" || $image!=" ")
														{
															$product_pic=$image;
														}
													}
													$price = $allAdds[0][$i]['price'];
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
														$price = "$ ".$allAdds[0][$i]['price'];
													}
													echo'<div class="item  col-xs-12 col-md-4 col-sm-4 col-lg-3">
														<div class="thumbnail">
															<div class="prod_img3">
																<a href="ViewAd/'.$allAdds[0][$i]['product_id'].'">
																<img class="item_img1" src="'.$product_pic.'" alt=""/></a>
															</div>
															
															<div class="caption2">
															  <div class="prod_h4">
																<a href="ViewAd/'.$allAdds[0][$i]['product_id'].'">
																	<h4>
																	'.$allAdds[0][$i]['title'] .'</h4>
																</a>
																</div>
															 
																<div class="prod_prc">
																	 <span class="br_thumbv">'.$price .' </span> 
																</div> 
																 <div class="prod_likes">
																			<div class="prod_adderess">
																				<div class="location_dv">
																					<a href="backpages/getitems.php?key=location&e='.$allAdds[0][$i]["location"].' "><i 	class="material-icons">location_on</i>
																					'.$allAdds[0][$i]["location"].'</a>
																				</div>
																			   <div class="prod_compny">
																					<a href="backpages/getitems.php?key=company&e='.$allAdds[0][$i]["company_name"].' ">	 <i class="material-icons">business</i>
																					'. $allAdds[0][$i]["company_name"].' </a> 
																				</div>
																			 </div>
																	<div class="prod_right_msg">';
																		 
																		if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
																		{
																			if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Verified")
																			{
																				if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Verified")
																				{
																					if($allAdds[0][$i]['user_id']==$_SESSION['session_web']['login_userId'])
																					{
																						echo' 
																								<i class="material-icons" aria-hidden="true" data-toggle="modal" data-target="#myModal2">person_outline</i> 							 
																							 ';
																					}
																					else
																					{
																					echo' 	
																							<input type="hidden" value="'.$allAdds[0][$i]['user_id'] .'-'.$allAdds[0][$i]['product_id'].'" >
																							<i class="material-icons popup" aria-hidden="true" >message</i> 							 
																							<input type="hidden" value="'.$allAdds[0][$i]['username'] .'">
																						 ';
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
																			echo' 	
																					<i class="material-icons" aria-hidden="true" onclick="checkLogin()">message</i> 							 
																				 ';
																		}
																	echo'</div></div>
															 
															</div>
														</div>
													</div>';	 
												}
											}
										}
									?>
								</div>						  
							 </div>  
							
							 <div id="tabs-3">
								<div id="products" class="row list-group">
								
									<?php 
											$status=$aroundMe['status'];
											
											if($status==0) // No Products Found
											{
												echo "<div class='Nodata'><h2 class='No_res_tab'>  Sorry! No Products Found In Database </h2></div>";
											}
											else
											{
											
												for($i=0;$i<count($aroundMe[0]);$i++)
												{
													$images=explode(",",$aroundMe[0][$i]['pro_image']);
													foreach($images as $image)
													{
														if($image!="" || $image!=" ")
														{
															$product_pic=$image;
														}

													}
													$price = $aroundMe[0][$i]['price'];
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
														$price = "$ ".$aroundMe[0][$i]['price'];
													}
													
													echo '  <div class="item  col-xs-12 col-md-4 col-sm-4 col-lg-3">
																<div class="thumbnail">
																	<div class="prod_img3">
																		<a href="ViewAd/'.$aroundMe[0][$i]['product_id'].'">
																		<img class="item_img1" src="'.$product_pic.'" alt=""/></a>
																	</div>
																	
																	<div class="caption2">
																		<div class="prod_h4">
																			<a href="ViewAd/'.$aroundMe[0][$i]['product_id'].'">
																			<h4>
																			'.$aroundMe[0][$i]['title'] .'</h4>
																			</a> 
																		</div>
																		 <div class="prod_prc">  
																			 <span class="br_thumbv">'.$price .' </span>  
																		</div>
																		 <div class="prod_likes">
																				<div class="prod_adderess">
																					<div class="location_dv">
																						<a href="backpages/getitems.php?key=location&e='.$aroundMe[0][$i]["location"].' "><i class="material-icons">location_on</i>
																					 '.$aroundMe[0][$i]["location"].' </a>
																					</div>   
																						<div class="prod_compny">
																							<a href="backpages/getitems.php?key=company&e='.$aroundMe[0][$i]["company_name"].' "> <i class="material-icons">business</i>
																					 '. $aroundMe[0][$i]["company_name"].'</a>
																					 </div> 				  
																				</div>
																				<div class="prod_right_msg">
																				';
																				if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
																				{
																					if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Verified")
																					{
																						if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Verified")
																						{
																							if($aroundMe[0][$i]['user_id']==$_SESSION['session_web']['login_userId'])
																							{
																								echo' 	
																										<i class="material-icons" aria-hidden="true" data-toggle="modal" data-target="#myModal2">person_outline</i> 							 
																									 ';
																							}
																							else
																							{
																								echo'
																									
																									<input type="hidden" value="'.$aroundMe[0][$i]['user_id'] .'-'.$aroundMe[0][$i]['product_id'].'">
																									<i class="material-icons popup" aria-hidden="true" >message</i>
																									<input type="hidden" value="'.$aroundMe[0][$i]['username'] .'">
																								 ';
																							}
																						}
																						else
																						{
																							echo' 
																								<i class="material-icons" aria-hidden="true" onclick="CompanyVerification()">message</i> 							 
																							 ';
																						}
																					}
																					else
																					{
																						echo' <i class="material-icons" aria-hidden="true"   	onclick="AccountVerification()">message</i> 							 
																							 ';
																					}
																				}
																				else
																				{
																					echo' 
																					<i class="material-icons " aria-hidden="true" onclick="checkLogin()">message</i> 							 
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
						</div>   
					</div><!--tabs close-->
					  
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
	<!-- //footer -->		
	<?php include "footer.php" ?>
	<!-- cart-js -->
	
	<!-- Loader Begins -->
		<div id="ark_loader" class="ark_loader" style="display:none;" >
			<span>
				<span class="innerLdr"><img src="img/loading.gif" style="height:150px" ></span>
			</span>
		</div>
	<!-- Loader Ends -->							 
</body>
</html>
<script>
$(document).ready(function() {
	$('#list').click(function(event){event.preventDefault();$('#products .item').removeClass('grid-group-item');$('#products .item').addClass('list-group-item list_class');$('.thumbnail .item_img1').css('display','none');$(this).css('color','red');$('#thumb').css('color','black');$('#grid').css('color','black');});
    $('#thumb').click(function(event){event.preventDefault();$('#products .item').removeClass('list_class');$('#products .item').addClass('list-group-item');$('.thumbnail .item_img1').css('display','block');$(this).css('color','red');$('#list').css('color','black');$('#grid').css('color','black');  });
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item thumb');$('#products .item').addClass('grid-group-item');$('.thumbnail .item_img1').css('display','block');$(this).css('color','red');$('#list').css('color','black');$('#thumb').css('color','black');});
});
</script>

<!-- *************** Location Finder *************** -->
<script src="UserLocationScript.js"> </script>
<!-- *************** Location Finder  *************** -->

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
						$("#emailError").html(response.emailError);
						//alertify.error(response.msg);
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
						
						//alertify.success(response.msg);
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