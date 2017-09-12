<?php 
include "backpages/connection.php";
include "backpages/timeago.php";
if(!isset($_SESSION['session_web']['valid']) || $_SESSION['session_web']['valid']!=true  )
{
	header('Refresh:1;url='.$url_root.'login.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait... ";
	die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell at Work Products</title>
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
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- web-fonts --> <link rel="icon" type="image/png" href="favicon.ico">
 
<!-- js -->
<script src="js/jquery-2.2.3.min.js"></script> 
<!-- //js --> 
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

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
 
</head>
<body>
<div id="My_conatiner"> 
	<!-- Header -->
	<?php include "header.php";	?>
	<!-- Header Ends -->
			<div class="margin_top" style="padding-top:3em;"></div>			
			 	
			<!-- Info Tip End -->
			<div class="clear"></div>
			
				<div class="Log_mateial_top" style="height:170px;position: relative;">
					<div class="account_user1">
						<i class="material-icons" style="transform:none;">verified_user</i>
					</div>
					<div>
						<h2 class="verify_h2">Please Verify Your company to post an Ad or Contact anyone </h2>
					</div>
				</div>
	 
		 <div id="verfication">
				<div class="wraper ">
					<form action="" method="post" id="msgForm">
						<div class="col-lg-6 col-lg-offset-3">
							<h3 class="w3ls-title w3ls-title1" style="margin-bottom:1em;">Company Verification</h3>  	
							<div class="form-grp">
								<input type="radio" class="radio1" name="verification" value="via_email" checked>
								 <div class="form_lbl"> Verify Via company  email ID</div>
								<div>
									<input type="text" class="email_text" name="email" placeholder="Email" id="email" autofocus="true" >
									<span class="error" id="emailError"> </span>
								</div>
							</div> 
								<center> OR </center>
							 <div class="form-grp">
								<input type="radio" class="radio1" name="verification" value="via_code">
								 <div class="form_lbl">Enter Comapny Code</div>
								<div>
									<input type="text" class="email_text" name="company_code" placeholder="Company code" id="companyCode">
									<span class="error" id="codeError"></span>
								</div>
							</div>
							<div class="form-grp">
								<input type="submit" class="submit1 btn">
							 </div> 
							<center> OR </center>
							<div class="form-grp"> 
								 <div class="form_lbl">Verify Via Linked In</div>
								<a href="verify/linkedin/process.php"><div>
									<input type="button" class="linkedIn" name="linkedIn" value="Linked IN" >
								</div></a>
							</div>
						</div>
					</form>
					<div class="clear"></div>
					
					
			  </div>	
				
			
				
		 </div>
	<!--=======Head  end=======-->
  <div class="clear"></div>
 
	<!-- Footer Begins-->
	<?php include "footer.php" ; ?>
	<!-- Footer Ends -->
	
</div>
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
	$('input:radio[name="verification"]').change(function()
	{
		if (this.checked && this.value == 'via_email') 
		{
			$("#email").prop('required',true);
			$("#companyCode").removeAttr('required');
			$("#companyCode").val();
		}
		else if(this.checked && this.value == 'via_code') 
		{
			$("#companyCode").prop('required',true);
			$("#email").removeAttr('required');
			$("#email").val();
		}
		else
		{
			$("#email").removeAttr('required');
			$("#companyCode").removeAttr('required');
			$("#companyCode").val();
			$("#email").val();
		}
    });
	
	
	// Send Message 
	$("#msgForm").on("submit",function(e)
	{
		e.preventDefault();
		$("#ark_loader").css("display","block");
		var verification=$("input:radio[name='verification']:checked").val();
		var email=$("#email").val();
		var companyCode=$("#companyCode").val();
		
		var jsonObj=
		{
			"verification" : verification,
			"email" : email,
			"company_code" : companyCode,
		};
		var data=JSON.stringify(jsonObj);
		
		$.ajax
		({
			url:"backpages/verificationRequest.php",
			type: "POST",
			data: data,
			success: function(response)
			{
				//alert(JSON.stringify(response));
				if(response.status==0)
				{
					$("#emailError").html(response.emailError);
					$("#codeError").html(response.codeError);
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
					$('#msgForm').trigger("reset");
					$("#emailError").html(response.emailError);
					$("#codeError").html(response.codeError);
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
	});
	
});
</script>