<?php 
@session_start();
session_destroy(); //Destroy All Sessions if Set
include "backpages/connection.php";
include "redirection_referer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SellAtWork.com Login  </title>
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
<!-- start-smooth-scrolling -->
<script src="js/bootstrap.js"></script>	
<!-- **************************** Alertify **************************** -->
<script src="js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="css/alertify/alertify.min.css"/>

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
					<div class="login-body" style="margin:2em auto;">
						<div class="account_user">
						<i class="material-icons">account_circle</i></div>
						<h3 class="w3ls-title w3ls-title1">Login Via </h3>  
						<form action="" method="post" id="form1">
							<div class="social_log" style="margin-bottom:2em">
							<div class="clear"></div>
								<div class="center">
									<span class="s1">
									<a href="https://www.sellatwork.com/sociallogin/redirecting.php?req=linked">
										<i class="fa fa-linkedin" aria-hidden="true"></i> </a> 
									</span>
 
										<span class="s2">
										<a href="https://www.sellatwork.com/sociallogin/redirecting.php?req=goog"></a>
										 </span>
									 
										<span class="s3">
											<a href="https://www.sellatwork.com/sociallogin/redirecting.php?req=fb"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										</span>	
									
									</div>
									 
									<center><h3 class="w3ls-title w3ls-title1" style="margin-top:1em;">OR</h3></center> 
								
							</div> 
							  
							<div class="form_wrape">
								  <div class="group"> 
									<div class="required"></div>
								 <input type="text" class="user" name="text" id="email" required="">
								  <span class="highlight"></span>
								 
								  <label> Enter you Email </label>
								   <span class="error errorClass"  id="emailError"></span>
								</div>
								  <div class="group">
									<div class="required"></div>								  
								  <input type="password" name="pass" class="lock" id="pwd" required="">
								  <span class="highlight"></span>
								  <label> Password </label>
								</div>
	 
							<div id="error-container"></div>
							<input type="submit" value="Login ">
							<div class="forgot-grid">
								<div class="checkbox"><input type="checkbox" name="checkbox"><i></i>Remember me</div>
								<div class="forgot">
									<a href="forgotPassword.php">Forgot Password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							</div>
						</form>
					</div>  
					<h6>Don't have an account? <a href="signup.php">Sign Up Now »</a> </h6>  
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
		var email=$("#email").val();
		var pwd=$("#pwd").val();
		var JSONObj = {
           "email" :email,
           "pwd"  :pwd,
       };
		var data = JSON.stringify(JSONObj);
		$.ajax
		({
			type: 'POST',
			url: 'backpages/loginApi.php',
			//dataType : 'json',
			data: data,
			success: function(response) 
			{
				//alert(response);
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
					//alertify.success(response.msg);
					$("#emailError").html(response.emailError);
					$('#form1').trigger("reset");					
					bootbox.dialog({
					message: '<p class="text-center">'+response.msg+'</p>',
					closeButton: false
					});
					setTimeout(function() {
							window.location.href =response.location;
							bootbox.hideAll();
						}, 2000);
				}
			}
		});
	});
});

</script>
 

