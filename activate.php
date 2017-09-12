<?php 
include "backpages/connection.php";
$method=$_SERVER['REQUEST_METHOD'];
if($method!="GET")
{
	header('Refresh:1;url='.$url_root.'login.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait... ";
	die;	
}
if(!isset($_GET['verification_code']) && !isset($_GET['verification_id']) && !isset($_GET['response_status']))
{
	header('Refresh:1;url='.$url_root.'login.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait... ";
	die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Activate Account </title>
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
  <div class="login-page">
		
		<?php 
			$verification_code=$_GET['verification_code'];
			$verification_response=$_GET['response_status'];
			$verification_id=$_GET['verification_id'];
			$sql_query=mysqli_query($conn,"select * from users where user_id=$verification_id and verification_code='$verification_code' ");
			$sql_rows=mysqli_num_rows($sql_query);
			
			if($sql_rows==1) // If Account Is Activated
			{
				
				// Update User table
				$login_status=1;
				$sql_query2=mysqli_query($conn,"update users set verified='Verified',last_login_on='$current_date_time',login_status=$login_status where user_id=$verification_id ");
				
				$sql_query3=mysqli_query($conn,"select * from users where user_id=$verification_id");
				
				$result=mysqli_fetch_array($sql_query3);
				$_SESSION['session_web']['valid']=true;
				$_SESSION['session_web']['login_userName']=$result['username'];
				$_SESSION['session_web']['login_userStatus']="Online";
				$_SESSION['session_web']['login_userId']=$result['user_id'];
				$_SESSION['session_web']['login_userEmail']=$result['email'];
				$_SESSION['session_web']['login_userPhoto']=$result['userphoto'];
				$_SESSION['session_web']['login_userVerified']=$result['verified'];
				
				// Update User table
				
				
		?>
			<div class="Log_mateial_top" style="height:220px;position: relative;">
				<div class="account_user1 Ok_act">
					<i class="material-icons" style="transform:none;">done</i>
				</div>
				
			</div>
			<div class="act_P" style="display:block;">
				<h1> Account Activated </h1>
				<br/>
					
				<?php echo"<script> setTimeout(function() {window.location.href = 'index.php'}, 2000);</script> " ;?>
			</div>
				
		<?php 
			}
			else // If Account Activation Fails
			{
		?>	
		 
				<div class="Log_mateial_top" style="height:220px;position: relative;">
					<div class="account_user1 Ok_act">
						<i class="material-icons">vpn_key</i>
					</div>
					
				</div>
				<div class="act_P" >
						<h1>Unautherized Access!! Verification Code Has been Modified</h1>
						<br/>
						<a href="login.php" class="log_active"> <i class="material-icons">vpn_key</i> Please Login</a>
					</div>
		<?php
			}
		?>
		
		
</div>
</div> 
<div class="clear"></div>
<!-- Footer Begins-->
<?php include "footer.php" ; ?>
<!-- Footer Ends -->
</body>
</html>

<!-- *************** Location Finder *************** -->
<script src="UserLocationScript.js"> </script>
<!-- *************** Location Finder  *************** -->
