<?php
include "backpages/connection.php";
include "backpages/timeago.php";
include "backpages/product_details.php";
include "backpages/makeLinks.php";
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
<title>SellAtWork.com</title>
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
 
			<div class="margin_top"></div> 
			<div class="clear"></div> 
			 <div id="single_items" style="margin:auto auto 0em;padding-bottom:4em;">
				<div class="wrape">
				<div class="col-lg-6  signle_q" >
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
							 <?php echo get_timeago(strtotime($json[0]['product_upload_on'])) ;?>
							 </span>
							 
							</h2>
							<div class="comp"> Seller work at
								<span>
									<?php echo $json[0]['product_user_company_name'] ;?>
									<i class="material-icons">business</i>
									<a href="Edit/<?php echo $json[0]['product_id'] ;?>" style="float:right;">
									<i class="fa fa-pencil" style="font-size: 13px;"></i>  </a>
								</span>
							 </div>
  
								<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width:644px; height: 400px; overflow: hidden; ">
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
									<div u="slides" style="cursor: move; position: absolute; left: 0;  margin:auto; top:0; width:644px; height: 350px;
										overflow: hidden;">
										<div>
											<div id="sliderh1_container" class="sliderh1" style="position: relative; top:0; left: 0;  margin:auto; width:644px;
												height: 300px;">
    
												<div u="slides" style="cursor: move; position: absolute; margin:auto; left: 0; top:0; width: 644px; height: 300px;
													overflow: hidden;">
													<?php
														$images=explode(",",$json[0]['product_pro_image']);
														$total_images=count($images);
														foreach($images as $image)
														{
															if($image!="" || $image!=" ")
															{
																echo "<div><a class='example-image-link' href='".$image."' data-lightbox='example-1'><img u='image' src='".$image."' class='auto_wdth' /></a></div>";
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
									 <?php echo $json[0]['product_location'] ;?>
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
				</div>
			 </div>
			 <div class="clear"></div>

</div>
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

			  var contenthtml= '<?php echo $json[0]['product_location'] ; ?>';
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

