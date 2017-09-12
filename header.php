<html>
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
  <!-- Search Auto complete -->
  <link rel="stylesheet" href="css/bootstrap-select.min.css" />
  <script type="text/javascript" src="js/bootstrap-select.min.js" ></script>
  <link rel="stylesheet" href="css/lightbox.min.css">
  <script src="js/lightbox-plus-jquery.min.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwCF_suJxK_ixjBgbL_lBtLUftezQRc6I&libraries=places&v=3"></script>		
<script src="js/jquery.geocomplete.min.js"></script>
<script>
$.noConflict();
jQuery(document).ready(function ($) {	
	$(".location").geocomplete({
	});

});
</script>

<script>	 
	$( function() 
	{
		var max_distance_val='<?php if (isset($_SESSION['search_filter_max'])){ echo $_SESSION['search_filter_max'] ;} else { echo 100 ; } ?>';
		var min_distance_val='<?php if (isset($_SESSION['search_filter_min'])){ echo $_SESSION['search_filter_min'] ;} else { echo 0 ; } ?>';
		
		// Mobile Range Slider
		$( "#slider-range1" ).slider({
			range: true,
			min: 0,
			max: 500,
			values: [ min_distance_val , max_distance_val ],
			slide: function( event, ui ) 
			{
				
				$( "#distance1" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] +" ");
				$("#radius1").val($( "#distance1" ).val() );
			}
		});
		$( "#distance1" ).val( $( "#slider-range1" ).slider( "values", 0 ) +
			" - " + $( "#slider-range1" ).slider( "values", 1 )  );
			$("#radius1").val($( "#distance1" ).val() );
			
		// web range Slider
		$( "#slider-range" ).slider({
			range: true,
			min: 0,
			max: 500,
			values: [ min_distance_val , max_distance_val ],
			slide: function( event, ui ) 
			{
				$( "#distance" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] +" ");
				$("#radius").val($( "#distance" ).val() );
			}
		});
		$( "#distance" ).val( $( "#slider-range" ).slider( "values", 0 ) +
			" - " + $( "#slider-range" ).slider( "values", 1 )  );
			$("#radius").val($( "#distance" ).val() );
			
			
		$('#Menu_srch').click(function()
		 {
			  $('#movile_wrap').toggle('slow');
		 });
		 $('#Mobile_menu').click(function()
		 {
			  $('#mobile_user').toggle('slow');
		 });
		 
	   $('.dropdown' ).hover(function()
	   {
			$(this).children('.sub-menu').slideDown(200);
	   },function()
	   {
			$(this).children('.sub-menu').slideUp(200);
	   });
			
		 $("#btnShow").click(function()
		{
			$("#dialog").slideToggle('slide');
		}); 
		$(".close_filer").click(function()
		{
			$("#dialog").hide('1000');
		}); 
	});
	
			
	function test()
	{
		bootbox.dialog({
		message: '<p class="text-center">Please Login To Add Products. </p>',
		closeButton: false
		});
		setTimeout(function() {
				window.location.href = "login.php";
				bootbox.hideAll();
			}, 2000);
			
	}
	function checkLogin()
	{

		bootbox.dialog({
		message: '<p class="text-center">Please Login To Send Message </p>',
		closeButton: false
		});
		setTimeout(function() {
				window.location.href = "login.php";
				bootbox.hideAll();
			}, 2000);
			
	}
	
	</script>
<script>
function CompanyVerification()
{
	$("#ark_loader").css("display","block");
	bootbox.dialog({
		message: '<p class="text-center">Please Verify Your Company </p>',
		closeButton: false
		});
	setTimeout(function() {
			window.location.href = "verification.php";
			bootbox.hideAll();
		}, 2000);	
}

function AccountVerification()
{
	$("#ark_loader").css("display","block");
	bootbox.dialog({
		message: '<p class="text-center">Please Verify Your Account.Check Your Mail </p>',
		closeButton: false
		});
	setTimeout(function() {
			$("#ark_loader").css("display","none");
			bootbox.hideAll();
		}, 2000);	
}
</script>
<script src="js/Profile_pic/jquery.imgareaselect.js" type="text/javascript"></script>
<script src="js/Profile_pic/jquery.form.js"></script>
<link rel="stylesheet" href="js/Profile_pic/imgareaselect.css">

</head>
	<body class="hed">
<div class="header">

<div class="col-sm-1 col-xs-1 pd_none">
		<div id="Mobile_menu"><i class="material-icons">menu</i></div>
	</div>
	<div class="col-sm-10 col-xs-8 pd_none">
		<a href="index.php"><img src="img/lightlogo.png" class="mobile_logo" alt=""/></a>
	</div>	
	<div class="col-sm-1 col-xs-3 pd_none">
 
  <div id="Menu_srch"><i class="material-icons">search</i></div>
  
  <div class="add_mobileIco">
  <?php 
    if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
    {
		if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Verified")
		{
			if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified'] =="Verified")
			{
				echo '<a href="add-product.php"  data-placement="bottom" onclick="CompanyVerification()" data-toggle="tooltip" title="Add Product"><i class="fa fa-plus" aria-hidden="true"></i></a>';
			}
		    else
			{
				  echo '<a href="#"  data-placement="bottom" onclick="CompanyVerification()" data-toggle="tooltip" title="Add Product"><i class="fa fa-plus" aria-hidden="true"></i></a>';
			}
		}
		else
		{
			echo '<a href="#"  data-placement="bottom" onclick="AccountVerification()" data-toggle="tooltip" title="Add Product"><i class="fa fa-plus" aria-hidden="true"></i></a>';
		}
  }
  else
  {
	 echo '<a href="#"  data-placement="bottom" onclick="test()" data-toggle="tooltip" title="Add Product"><i class="fa fa-plus" aria-hidden="true"></i></a>';
  }
?>
   
  </div>
  
 </div>
	
	
	 
		<div class="logo">
			<a href="index.php"><img src="img/lightlogo.png" alt=""/></a>
		</div>
		 
		<div id="Head_section">
						<form action="backpages/searchApi.php"  method="POST">				 
							<div class="search_col3 w34">
							<div class="srch_out">
									<input type="text" style="width:88% !important;" class="form-control txt" name="searchKey" placeholder="Search your Keywords here...."  id="search1" />	
									<button type="submit" name="search" class="btn_search" id="search_btn" >							
										<div class="icon1">search</div>
								    </button>
							</div>								 
							</div>
							
							<div class="search_col3 ico_drop w15">									 								 
								<button class="filter_btn " onclick="return false;" id="btnShow"><i class="material-icons">filter_list</i>Filter								
								</button>
							</div>				 	
							 
							 
							 <!--dailog box-->
							<div id="dialog" style="display:none" align = "center">	
								 <div class="main">						 
									 
									 <div class="close_filer"><i class="fa fa-times" aria-hidden="true"></i></div>
										<div class="clear"></div>							 
									 <div class="group">									 
									 <input type="text" class="form-control location" style="width:100%;"  name="location"   value="<?php if(isset($_SESSION['search_location'])){	echo $_SESSION['search_location']; } elseif (isset($_COOKIE["UserLocation"])){	echo $_COOKIE["UserLocation"]; } else {	echo "Mountain View, California, United States"; }  ?>"  placeholder=""  />
									 <span class="highlight"></span>
									<label>Enter a Location</label>
									</div>
									  
									 <div class="form-group">
									 <div class="prc_reng">
											<span class="prc_reng">Distance range (in miles):</span>
									</div>
									<div class="pric_text">
										<input type="text" id="distance"  class="price_form" readonly >
										<input type="hidden" id="radius"  name="radius" >
									</div>	
									
									<div class="clear"></div>
									<div class="left_rang_ic">
									<i class="fa fa-map-marker" aria-hidden="true"></i>
									</div>
									<div id="slider-range"></div> 
									<div class="ryt_rang_ic">
									<i class="fa fa-car" aria-hidden="true"></i>
									 </div>
									 </div>
									 <div class="form-group">
									 <div class="form_lbl"> Categories</div>
									 <select class="select2" name="category"> 
										<option value="All" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="All" ){ echo "selected"; } else {	echo ""; }  ?>>All</option>
										<option value="Furniture" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Furniture" ){ echo "selected"; } else {	echo ""; }  ?>>Furniture</option>
										<option value="Baby Items" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Baby Items" ){ echo "selected"; } else {	echo ""; }  ?>>Baby Items</option>
										<option value="Housing" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Housing" ){ echo "selected"; } else { echo ""; }  ?>>Housing</option>
										<option value="Electronics" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Electronics" ){ echo "selected"; } else { echo ""; } ?>>Electronics</option>
										<option value="eGarage-Sales" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="eGarage-Sales" ){ echo "selected"; } else { echo ""; }  ?>>eGarage-Sales</option>
										<option value="Other" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Other" ){ echo "selected"; } else { echo ""; }  ?>>Other</option>
										<option value="Free" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Free" ){ echo "selected"; } else { echo ""; }  ?>>Free</option>
										<option value="Bikes and Autos" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Bikes and Autos" ){ echo "selected"; } else { echo ""; }  ?>>Bikes and Autos</option>
									</select>
										 <span class="select2i">  <i class="fa fa-caret-down"></i> </span>
										</div>
										
									<div class="form-group">
									 <div class="form_lbl">Company Name</div>
									   <div class="clear"></div>
									   <div class="select_wrap">
										  <select class="selectpicker dropup " title="All"  data-width="fit" multiple data-size="5" data-actions-box="true" data-selected-text-format="count > 1" data-live-search="true"  name="company[]">
											  <?php 
												   if (isset($_SESSION['search_company']))
													{
														$comp_array=$_SESSION['search_company'];
													}
													else
													{
														$comp_array=array();
													}
												$sql=mysqli_query($conn,"select distinct company_name from users where company_name!='' order by company_name asc ");
												while($fetch=mysqli_fetch_array($sql))
												{
													if(in_array($fetch['company_name'],$comp_array))
													{
														$selected="selected";
													}
													else
													{
														$selected="";
													}
													echo '<option  value="'.$fetch['company_name'].'" '.$selected.' >'. $fetch['company_name'].'</option>';
												}
											  ?>
											</select>
									</div>
									</div>
 
									<button type="submit" class="apply_btn">Apply Filter </button>
								 </div>
							</div>
							
							<!--dailog box-->
						</form>
						
						<!--Add Products -->
						<?php 
						   if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
						  {
								if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Verified")
								{
									if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified'] =="Verified")
									{
									  echo '<div class="Pluse">							  
													 <a href="add-product.php" data-placement="bottom" data-toggle="tooltip" class="Pluse" title="Add Product"> 
													<i class="fa fa-plus" aria-hidden="true"></i>
													</a>  
											</div>';
									 }
									 else
									 {
										  echo '<div class="Pluse">							  
													 <a href="#" data-placement="bottom" onclick="CompanyVerification()" data-toggle="tooltip" class="Pluse" title="Add Product"> 
													<i class="fa fa-plus" aria-hidden="true"></i>
													</a>  
											    </div>';
									  }
								}
								else
								{
									 echo '<div class="Pluse">							  
													 <a href="#" data-placement="bottom" onclick="AccountVerification()" data-toggle="tooltip" class="Pluse" title="Add Product"> 
													<i class="fa fa-plus" aria-hidden="true"></i>
													</a>  
											    </div>';
								}
						  }
						  else
						  {
							  echo '<div class="Pluse">							  
											 <a href="#" onclick="test()" data-placement="bottom" data-toggle="tooltip" class="Pluse" title="Add Product"> 
												<i class="fa fa-plus" aria-hidden="true"></i>
											</a>  
									</div>';
						  }
						?>
						<!-- Add Products Ends -->
						  <div class="category_dv">	  
							 <nav>
								<ul>								   
									<li class="dropdown">
										<a href="#">Categories <i class="material-icons">arrow_drop_down</i></a>
										<ul class="sub-menu">										   
										<li class="dropdown"> <a href="backpages/getitems.php?key=cat&e=Furniture"><i class="material-icons">card_travel</i>Furniture</a> </li>											
										<li class="dropdown"> <a href="backpages/getitems.php?key=cat&e=Baby Items"> <i class="material-icons">child_care</i>Baby-items</a> </li>											
										<li class="dropdown"> <a href="backpages/getitems.php?key=cat&e=Housing"> <i class="material-icons">home</i>Housing</a> </li>
						<li class="dropdown"> <a href="backpages/getitems.php?key=cat&e=Electronics"> <i class="material-icons">home</i>Electronics</a> </li>
										
										<li class="dropdown"> <a href="backpages/getitems.php?key=cat&e=eGarage-Sales"><i class="material-icons">store</i>E-garage-Sales</a> </li>										
										<li class="dropdown"> <a href="backpages/getitems.php?key=cat&e=Free"> <i class="material-icons">flare</i>Free</a> </li>											
										<li class="dropdown"> <a href="backpages/getitems.php?key=cat&e=Other"><i class="material-icons">add_shopping_cart</i>Other</a> </li>											
										<li class="dropdown"> <a href="backpages/getitems.php?key=cat&e=Bikes and Autos"><i class="material-icons">local_car_wash</i>Bikes and Autos</a> </li>											
										</ul>
									</li>									 
								</ul>
								</nav>
								</div>
						</div>
			<?php
			if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
			{
				if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Verified")
				{
					echo '<div class="right_log">						  
									<div class="category_dv" id="profile_Drop">	  
								 <nav>
									<ul>								   
										<li class="dropdown">
											<img class="img_prof" src="'.$_SESSION['session_web']['login_userPhoto'] .'" alt=""/>
											<ul class="sub-menu">										   
											<li class="dropdown"> <a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i>
												Setting</a> 
											</li>	
											<li class="dropdown"> <a href="inbox.php"><i class="fa fa-envelope" aria-hidden="true"></i>
												Inbox </a> 
											</li>
											<li class="dropdown"> <a href="mylist.php"><i class="fa fa-list" aria-hidden="true"></i>
												My list</a> 
											</li>
											<li class="dropdown"> <a href="myrequest.php"><i class="material-icons">touch_app</i>
												My Request</a> 
											</li>										
											 <li class="dropdown"> <a href="backpages/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
											Logout</a> </li>											
											</ul>
										</li>									 
									</ul>
									</nav>
									</div>
							</div>';
				}
				else
				{
					echo '<div class="right_log">						  
							<div class="category_dv" id="profile_Drop">	  
							 <nav>
								<ul>								   
									<li class="dropdown">
										<img class="img_prof" src="'.$_SESSION['session_web']['login_userPhoto'].'" alt=""/>
										<ul class="sub-menu">										   
										<li class="dropdown"> <a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i>
											Setting</a> 
										</li>	
										<li class="dropdown"> <a href="backpages/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
										Logout</a> </li>											
										</ul>
									</li>									 
								</ul>
								</nav>
								</div>
						</div>';
				}
			}
			else
			{
				echo '<div class="right_log">
						<a href="login.php"><span class="log_link"><i class="fa fa-user" aria-hidden="true"></i> Login </span></a>
							<a href="signup.php"><span class="log_link"><i class="fa fa-sign-in" aria-hidden="true"></i> Signup </span></a>
					</div>';
			}
			
		?>
		 <!--mobile user section-->
	<?php
		if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
		{
			if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Verified")
			{
	?>
				<!-- If Company is Verified -->
				<div id="mobile_user">
					<div class="wraper">
						<div class="user_img">
							<?php echo '<img src="'.$_SESSION['session_web']['login_userPhoto'] .'" alt="" />' ; ?>
						</div>
							<div class="name1"><?php echo $_SESSION['session_web']['login_userName'] ; ?></div>
							<div class="name"><?php echo $_SESSION['session_web']['login_userEmail'] ; ?></div>
					</div>
						<div class="user_menu_li">			
							<ul id="Mobile_li">
							<?php 
							echo '<li><a href="inbox.php">  <i class="material-icons mob_clr">email</i> Inbox </a></li>
								<li><a href="settings.php">  <i class="material-icons mob_clr">settings</i> Setting </a></li>
								<li><a href="mylist.php">  <i class="material-icons mob_clr">view_list</i> My List </a></li>
								<li><a href="myrequest.php">  <i class="material-icons mob_clr">view_list</i> My Requests </a></li>
								<li><a href="add-product.php"> <i class="material-icons">add_box</i> Add Products </a></li>
								<li><a href="backpages/logout.php">  <i class="material-icons mob_clr">lock_open</i> Logout </a></li>	';
							?>
							</ul>
						</div>
				</div>
	<?php
			}
			else
			{
	?>
				<div id="mobile_user">
					<div class="wraper">
						<div class="user_img">
							<?php echo '<img src="'.$_SESSION['session_web']['login_userPhoto'] .'" alt="" />' ; ?>
						</div>
							<div class="name1"><?php echo $_SESSION['session_web']['login_userName'] ; ?></div>
							<div class="name"><?php echo $_SESSION['session_web']['login_userEmail'] ; ?></div>
					</div>
					<div class="user_menu_li">			
						<ul id="Mobile_li">
						<?php 
						echo '<li><a href="settings.php">  <i class="material-icons mob_clr">settings</i> Setting </a></li>
							<li><a href="backpages/logout.php">  <i class="material-icons mob_clr">lock_open</i> Logout </a></li>	';
						?>
						</ul>
					</div>
				</div>
	<?php
			}
		}
		else
		{
	?>		
			<div id="mobile_user">
				<div class="wraper">
					<div class="user_img">
						<img src="upload/defaultUserPic.jpg" alt="" />
					</div>
						<div class="name1">Guest</div>
				</div>
					<div class="user_menu_li">			
						<ul id="Mobile_li">
						<?php 
						echo '
						<li><a href="signup.php">  <i class="material-icons mob_clr">view_list</i> Signup </a></li>
						<li><a href="login.php">  <i class="material-icons mob_clr">lock_open</i> Login </a></li>	';
						?>
						</ul>
					</div>
			</div>
		<?php 
		}
	?>
		 <!--mobile user search-->
	<div id="movile_wrap">	
		 <div class="main_mobile">
		 <ul class="nav_mobile">
		
		  
	  <form action="backpages/searchApi.php" method="post">
		 <li>
		 <div class="group">
			<input type="text" name="searchKey"   class="form-control"/>
			   <span class="highlight"></span>
				<label>Search your Keywords here....</label>  
		 </li>
			 <li>		 	
			  <div class="group">
					 <input type="text" class="form-control location"  placeholder="" name="location" value="<?php if(isset($_SESSION['search_location'])){	echo $_SESSION['search_location']; } elseif (isset($_COOKIE["UserLocation"])){	echo $_COOKIE["UserLocation"]; } else {	echo "Mountain View, California, United States"; } ?>" />
					   <span class="highlight"></span>
					 <label>Enter a Location</label>  
			  </div>
			</li>			 
			<li>
			 <div class="form-group">
				 <div class="prc_reng">
						<span class="prc_reng">Distance range (in miles):</span>
					</div>
				<div class="pric_text">
						<input type="text" id="distance1" class="price_form"  readonly>
						<input type="hidden" id="radius1"  name="radius">
				</div>	
				<div class="clear"></div>
				<div class="left_rang_ic">
						<i class="fa fa-map-marker" aria-hidden="true"></i>
				</div>
					<div id="slider-range1"></div> 
					<div class="ryt_rang_ic">
					<i class="fa fa-car" aria-hidden="true"></i>
					 </div>
			 </div>
			</li>
			<li>
				 <div class="form-group">
					 <div class="form_lbl">Categories</div>
					 <select class="select2" name="category"> 
						<option value="All" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="All" ){ echo "selected"; } else {	echo ""; }  ?>>All</option>
						<option value="Furniture" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Furniture" ){ echo "selected"; } else {	echo ""; }  ?>>Furniture</option>
						<option value="Baby Items" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Baby Items" ){ echo "selected"; } else {	echo ""; }  ?>>Baby Items</option>
						<option value="Housing" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Housing" ){ echo "selected"; } else { echo ""; }  ?>>Housing</option>
						<option value="Electronics" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Electronics" ){ echo "selected"; } else { echo ""; } ?>>Electronics</option>
						<option value="eGarage-Sales" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="eGarage-Sales" ){ echo "selected"; } else { echo ""; }  ?>>eGarage-Sales</option>
						<option value="Other" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Other" ){ echo "selected"; } else { echo ""; }  ?>>Other</option>
						<option value="Free" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Free" ){ echo "selected"; } else { echo ""; }  ?>>Free</option>
						<option value="Bikes and Autos" <?php if(isset($_SESSION['search_category']) && $_SESSION['search_category']=="Bikes and Autos" ){ echo "selected"; } else { echo ""; }  ?>>Bikes and Autos</option>
					</select>
					<span class="select2i">  <i class="fa fa-caret-down"></i> </span>
				</div>
			 </li>	 
			 <li>
				<div class="form-group">
					  <div class="form_lbl"> Company Name </div>
					  <select class="select2 selectpicker dropup" title="All"  data-width="fit" multiple data-size="5" data-actions-box="true" data-selected-text-format="count > 1" data-live-search="true"  name="company[]">
					  <?php 
						    if(isset($_SESSION['search_company']))
							{
								$comp_array=$_SESSION['search_company'];
							}
							else
							{
								$comp_array=array();
							}
							$sql=mysqli_query($conn,"select distinct company_name from users where company_name!='' order by company_name asc ") or die (mysqli_error($conn)."error in query");
							while($fetch=mysqli_fetch_array($sql))
							{
								if(in_array($fetch['company_name'],$comp_array))
								{
									$selected="selected";
								}
								else
								{
									$selected="";
								}
								echo '<option value="'.$fetch['company_name'].'" '. $selected.' >'. $fetch['company_name'].'</option>';
							}
							
					  ?>
					</select>
					  
				</div>
			 </li>	 
 
			<li>				
			<button type="submit" class="apply_btn">Apply Filter </button>
			 </li>
		 </form>
		 </ul>
		 </div>
		
		</div>
	</div>
 	<!--mobile menu-->
	</div>
	  
  
		</body>
		</html>
<script>
$("#search_btn").click(function()
{
	$("#search1").prop('required',true);
});
$("#btnShow").click(function()
{
	$("#search1").prop('required',false);
});
</script>
