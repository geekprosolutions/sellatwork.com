<?php 
@session_start();
session_destroy();
include "backpages/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SellAtWork.com Sign-up </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

<script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>

<!-- start-smooth-scrolling -->

<script src="js/bootstrap.js"></script>	
<!--model popup link-->
<!-- **************************** Alertify **************************** -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<!-- **************************** Alertify Ends **************************** -->
</head>
<body>
<div id="My_conatiner">
<!-- Header starts -->
<?php include "header.php" ;?>
<!--Header Ends -->	

  <div class="clear"></div>
  <!--slider-->
   
  <div class="login-page">
	<div class="Log_mateial_top"></div>
		<div class="Log_mateial_main">			
			<div class="login-body" style="margin:2em auto ;">
				<div class="account_user">
						<i class="material-icons">person_add</i></div>
						<form action="#" method="post" id="form1">
						<h3 class="w3ls-title w3ls-title1">Sign Up Via</h3>  						
							<div class="social_log" style="margin-bottom:2em; float:none;">
							<div class="clear"></div>
								<div class="center">								
									<span class="s1">
									<a href="sociallogin/redirecting.php?req=linked">
									<i class="fa fa-linkedin" aria-hidden="true"></i>  
								</a>
								</span>
								<span class="s2">
									<a href="sociallogin/redirecting.php?req=goog">
									 
								</a>
								</span>
								<span class="s3">
								<a href="sociallogin/redirecting.php?req=fb">
									<i class="fa fa-facebook" aria-hidden="true"></i>  
								</a> 
								 </span>	
								</div>
								<div class="clear"></div>
								<br />  
								<center>
								<h3 class="w3ls-title w3ls-title1">OR </h3> 
								</center> 
							</div>  
							
						
								
						 <div class="group"> 
							<div class="required"></div>
							<input type="text" class="user email_text" name="email" id="email" required >
								<span class="highlight"></span>
								  <label>me@example.com</label>
								   <span id="emailError" class="error errorClass" style="top:-13px;"></span>
						 </div>
						 
						 
						 <div class="group">  
							<div class="required"></div>
							<input type="password" name="pwd" class="lock"  id="pwd" required>
								  <span class="highlight"></span>
								  <label>Password</label>
						 </div>
						 
						 <div class="group">  
							<div class="required"></div>
							<input type="password"  name="confirmPwd" id="confirmPwd" required />
							
								  <span class="highlight"></span>
								  <label>Confirm Password</label>
						 </div>
						 <span id="pwdError" class="error error_pwd"></span> 
						 
						 
						 <div class="group">   
							<div class="required"></div>
								  <input type="text" class="user" name="username"  id="username" required>
								  <span class="highlight"></span>
								  <label>Enter your name</label>
						</div>

						 <div class="group" >    
							  <div class="required"></div>
							  <input type="text" name="company" class="lock" id="company">
							  <span class="highlight"></span>
							  <label>Company Name</label>
						 </div>
						 <div class="group">   
							<div class="required"></div>
							<input type="text" name="location" placeholder="" value="<?php if (isset($_COOKIE["UserLocation"])){ echo  $_COOKIE["UserLocation"] ;} else { echo "Mountain View, California, United States";}  ?>" class="user location"  id="locations" required autocomplete="off" >
								  <span class="highlight"></span>
								  <label>Location</label>
						 </div>
						
						 
					<input type="submit" value="Sign Up ">
					 	 	 	 
				</form>
			</div>  
			<h6>Already have an account? <a href="login.php">Login Now »</a> </h6>  
		</div>
	</div>
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

<script>
$(document).ready(function()
{
	$("#form1").on("submit",function(e)
	{
		e.preventDefault();
		$("#ark_loader").css("display","block");
		
		var username=$("#username").val();
		var email=$("#email").val();
		var pwd=$("#pwd").val();
		var confirmPwd=$("#confirmPwd").val();
		var company=$("#company").val();
		var locations=$("#locations").val();
		
		
		if(pwd!=confirmPwd)
		{
			$("#ark_loader").css("display","none");
			$("#pwdError").html("* Password Does not match");
		}
		else
		{
			$("#pwdError").html("");
			
			var JSONObj = {
			   "username" :username,
			   "email"  :email,
			   "pwd"  :pwd,
			   "company"  :company,
			   "location"  :locations,
			  
		   };
			var data = JSON.stringify(JSONObj);
			
			$.ajax
			({
				type: 'POST',
				url: 'backpages/signupApi.php',
				data: data,
				success: function(response) 
				{
					//alert(JSON.stringify(response));
					if(response.status==0)
					{
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
						$('#form1').trigger("reset");
						$("#emailError").html(response.emailError);
						bootbox.dialog({
						message: '<p class="text-center">'+response.msg+'</p>',
						closeButton: false
						});
						setTimeout(function() {
								window.location.href =window.location.href = "login.php";
								bootbox.hideAll();
							}, 3000);
							
					}
					
				}
			});
		}
	});
});
</script>
