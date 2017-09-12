<?php 
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
<link href="../css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style --> 
<link href="styles.css" rel="stylesheet" type="text/css" media="all" /> 
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
<?php include "header.php"; ?>
<div class="clear"></div>
<!--slider-->

  <div class="login-page">
		<div class="Log_mateial_top"></div>
			<div class="Log_mateial_main">
				<div class="login-body">
					<div class="account_user">
					<i class="material-icons">account_circle</i></div>
					<h3 class="w3ls-title w3ls-title1">Edit Url Root</h3>  
					<form action="" method="post" id="form1">
						<input type="text" class="user"  placeholder="Old Url" id="old_url" value="<?php echo $_SESSION['session_admin_web']['login_url_root'] ;?>" readonly>
						<input type="text"  class="lock" placeholder="Enter New Url" id="new_url" required>
						<div id="error-container"></div>
						<input type="submit" value="Update">
					</form>
				</div>  
			</div>
	</div>
	 	 
</div> 
</body>
</html>
 
<script>
$(document).ready(function()
{
	$("#form1").on("submit",function(e)
	{
		
		e.preventDefault();
		var new_url=$("#new_url").val();
		var JSONObj = {
           "new_url" :new_url,
       };
		var data = JSON.stringify(JSONObj);
		$.ajax
		({
			type: 'POST',
			url: 'updateUrl.php',
			dataType : 'json',
			data: data,
			success: function(response) 
			{
				//alert(response);
				if(response.status==0)
				{
					alertify.error(response.msg);
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
 