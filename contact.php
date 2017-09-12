<?php
include "backpages/connection.php" ;
?>
<!DOCTYPE html>
<!-- saved from url=(0030)http://sellatwork.com/terms.htm -->
<html>
<title>Sell at Work Online Shopping </title>
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
<script src="js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="css/alertify/alertify.min.css"/>
<!-- **************************** Alertify Ends **************************** -->
</head>
<body class="contact_bg">
<div id="My_conatiner">
<!-- Header starts -->
<?php include "header.php" ;?>
<!--Header Ends -->	
<div class="clear"></div>
<div class="faq_wraper" style="background-color:transparent; float:left;">
<div class="col-lg-5 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-offset-3 col-xs-12 col-xs-offset-0">
<div class="faq_main" style="padding-left:2em; background-color:rgba(255, 255, 255, 0.9);">
<h1>
	Contact Us
</h1>
		 <div class="conatct_wrape">
		 <form action="#" method="post" id="form1">
			 <div class="form-group group">
			 <input type="email" class="form-coontrol"   id="email" style="border:1px solid #eee;" required />
			 <span class="error" id="emailError"></span>
			 <span class="highlight"></span>
				<label>Email</label>
			 </div>
			    			
			 <div class="form-group">
				<textarea placeholder="Your Message" class="form-control" style="width:100%"  id="message" required/></textarea>
			 </div>
			 <div class="form-group">
			  <input type="submit" style="background-color:#F55B44; border:1px solid #F55B44; color:#fff;"   value="Submit" />
			 </div>
		</form>
		 </div>
</div>
</div>

</div>
<?php include "footer.php" ; ?>
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
	$("#form1").submit(function(e)
	{
		e.preventDefault();
		 $("#ark_loader").css("display","block");
		var email=$("#email").val();
		var message=$("#message").val();
		
		var data={ 
			'email': email,
			'message': message,
		}
		
		$.ajax
		({
			url : 'backpages/ContactMessage.php',
			type: 'post',
			data : data,
			success : function(response)
			{
				//alert(response);
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
					$("#emailError").html(response.emailError);
					$('#form1').trigger("reset");
					bootbox.dialog({
					message: '<p class="text-center">'+response.msg+'</p>',
					closeButton: false
					});
					setTimeout(function() {
						   window.location.href ="index.php";
							bootbox.hideAll();
						}, 3000);
				}
			}
		});
	});
});
</script>
   