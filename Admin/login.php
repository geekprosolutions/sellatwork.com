<?php 
ob_start();
session_start();
session_destroy(); //Destroy All Sessions if Set
include "../backpages/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell It Work Online Shopping </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Smart Bazaar Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- Custom Theme files -->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="styles.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="../css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style --> 
<link href="../css/ken-burns.css" rel="stylesheet" type="text/css" media="all" /> <!-- banner slider --> 
<link href="../css/animate.min.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="../css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->  
<!-- web-fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lovers+Quarrel" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Offside" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Tangerine:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- web-fonts --> 

<!-- js -->
<script src="../js/jquery-2.2.3.min.js"></script> 
<!-- //js --> 
<!-- font-awesome icons -->
<link href="../css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!--range slider-->
<link rel="stylesheet" href="../css/jquery_ui.css">
	<script src="../js/range_slider/jquery_ui.js"></script>


<script src="../js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
<!-- start-smooth-scrolling -->
<script src="../js/bootstrap.js"></script>	
<!--model popup link-->
<script type="text/javascript">
	 	 $(document).ready(function(){
    $("#btnShow").click(function(){
    $("#dialog").slideToggle('slide');
}); 
$(".close_filer").click(function(){
    $("#dialog").hide('1000');
}); 
});
$(document).ready(function() {
$('#Mobile_menu').click(function(){
      $('#mobile_user').toggle('slow');
  });
  }); 
  
$(document).ready(function() {
    $( '.dropdown' ).hover(
        function(){
            $(this).children('.sub-menu').slideDown(200);
        },
        function(){
            $(this).children('.sub-menu').slideUp(200);
        }
    );
}); // end ready
</script>
<!-- **************************** Alertify **************************** -->
<script src="../js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="../css/alertify/alertify.min.css"/>
<!-- **************************** Alertify Ends **************************** -->
</head>
<body>
<div id="My_conatiner">
<div class="header">
	<div class="logo">
		<img src="../img/lightlogo.png" alt=""/>
	</div>
</div>
<div class="clear"></div>
<!--slider-->

  <div class="login-page">
		<div class="Log_mateial_top"></div>
			<div class="Log_mateial_main">
				<div class="login-body">
					<div class="account_user">
					<i class="material-icons">account_circle</i></div>
					<h3 class="w3ls-title w3ls-title1">Admin Login</h3>  
					<form action="" method="post" id="form1">
						<input type="text" class="user" name="text" placeholder="Enter your name" id="username" required="">
						<input type="password" name="pass" class="lock" placeholder="Password" id="pwd" required="">
						<div id="error-container"></div>
						<input type="submit" value="Login ">
					</form>
				</div>  
			</div>
	</div>
	 	 
</div> 
<!-- Loader Begins -->
		<div id="ark_loader" class="ark_loader" style="display:none;" >
			<span>
				<span class="innerLdr"><img src="../img/loading.gif" style="height:150px" ></span>
			</span>
		</div>
	<!-- Loader Ends -->	
</body>
</html>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
$(document).ready(function()
{
	$("#form1").on("submit",function(e)
	{
		e.preventDefault();
		$("#ark_loader").css("display","block");
		var username=$("#username").val();
		var pwd=$("#pwd").val();
		var JSONObj = {
           "name" :username,
           "pwd"  :pwd,
       };
		var data = JSON.stringify(JSONObj);
		$.ajax
		({
			type: 'POST',
			url: 'loginApi.php',
			data: data,
			cache :false,
			success: function(response) 
			{
				//alert(response);
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
					alertify.success(response.msg);
					$('#form1').trigger("reset");
					setTimeout(function() { window.location.href ="adminPanel.php"}, 2000);
				}
			}
		});
	});
});
</script>
 