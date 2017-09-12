<?php 
include "backpages/connection.php";
$method=$_SERVER['REQUEST_METHOD'];
if($method=="GET")
{
	if(isset($_GET['e']))
	{
		$token=$_GET['e'];
	}
	else
	{
		header('Refresh:1;url='.$url_root.'index.php');
		echo "Unauthorized Access! Redirecting Please Wait... ";
		die;
	}
}
else
{
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Unauthorized Access! Redirecting Please Wait... ";
	die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Reset Password </title>
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
<link rel="icon" type="image/png" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lovers+Quarrel" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Offside" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Tangerine:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
<!-- web-fonts --> 
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
<!-- **************************** Alertify Ends **************************** -->
<style>
.error
{
	float: left;
    padding-left: 10px;
    font-size: 11px;
    color: red;
    margin-top: 1
}
</style>
</head>
<body>
<div id="My_conatiner">
<!-- Header starts -->
<?php include "header.php" ;?>
<!--Header Ends -->	
  <div class="clear"></div>
  <!--slider-->
  <div class="login-page" style="min-height:625px;">
  	<div class="Log_mateial_top" style="height:170px;position: relative;">
		<div class="account_user1">
			<i class="material-icons">vpn_key</i>
		</div>
	</div>
	<div class="down_arrow"></div>
		<div class="Log_mateial_main">			
			<div class="login-body" style="margin:2em auto 0;">
				<h3 class="w3ls-title w3ls-title1" style="margin-bottom:1em;">Reset Password?</h3>  
				<p> Reset Your password </p>
				<form action="#" method="post" id="form1">
					<div class="group">      
						<input type="password" class="user lock" name="new_password" id="new_password" required >
							<span class="highlight"></span>
						<label>New Password</label>
					</div>	
					<div class="group">      
						<input type="password" class="user lock" name="confirm_password" id="password_confirm" required >
							<span class="highlight"></span>
						<label>Confirm Password </label>
					</div>						
					<span id="confirmError" class="error"></span> 				
					<input type="submit" value="Submit">					 
				</form>
			</div>  
			<h6>Remember Passsword ?<a href="login.php">  Back to Login page <<</a> </h6>  
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
<script>
$(document).ready(function()
{
	$("#form1").on("submit",function(e)
	{
		e.preventDefault();
		$("#ark_loader").css("display","block");
		var password=$("#new_password").val();
		var confirm_password=$("#password_confirm").val();
		var token= "<?php echo $token ; ?>";
		if(password!=confirm_password)
		{
			$("#confirmError").html("* Password Does Not Match ");
			$("#ark_loader").css("display","none");
		}
		else
		{
			var JSONObj = 
			{
				   "password" : password,
				   "token" : token,
			};
			var data = JSON.stringify(JSONObj);
			$.ajax
			({
				type: 'POST',
				url: 'backpages/reset_pwd.php',
				//dataType : 'json',
				data: data,
				success: function(response) 
				{
					//alert(JSON.stringify(response));
					if(response.status==0)
					{
						$('#form1').trigger("reset");
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
						bootbox.dialog({
						message: '<p class="text-center">'+response.msg+'</p>',
						closeButton: false
						});
						setTimeout(function() {
							  window.location.href = "index.php";
								bootbox.hideAll();
							}, 2000);
					}
					
				}
			});
		}
	});
});
</script>

<!-- *************** Location Finder *************** -->
<script src="UserLocationScript.js"> </script>
<!-- *************** Location Finder  *************** -->
