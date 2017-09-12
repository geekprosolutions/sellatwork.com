<?php 
// Logout If Person is inactive For Defined Time Period

if (!isset($_SESSION['session_admin_web']['valid'])) 
{
	$json=array("status"=>0,"msg"=>"Unautherized Access!. Please Login.");
	echo json_encode($json);
	echo" <br / > <a href='login.php'><button> Please  Login </button></a>";
	die;
}								
?>
<html>
<head>
 
<script>
 $(document).ready(function(){ 
	$(window).resize(function() {
		$('#movile_wrap').hide();
		$('#mobile_user').hide(); 
	});
	  		
		$('#Mobile_menu1').click(function()
		 {
			  $('#admin_menu_display').toggle('slow');
		 }); 	   
 });
</script>
  
  <!-- Search Auto complete -->
  <link rel="stylesheet" href="../css/bootstrap-select.min.css" />
  <script type="text/javascript" src="../js/bootstrap-select.min.js" ></script>


 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</head>
	<body class="hed">
<div class="header">
		<div class="col-sm-1 col-xs-1 pd_none">
			<div id="Mobile_menu"><i class="material-icons">menu</i></div> 
		</div>
		
		<div class="col-sm-10 col-xs-8 pd_none">
		<a href="index.php"><img src="../img/lightlogo.png" class="mobile_logo" alt=""/></a>
		</div>	
		  
		<div class="logo">
			<img src="../img/lightlogo.png" alt=""/>
		</div>
		<?php
			if(isset($_SESSION['session_admin_web']['valid']) && $_SESSION['session_admin_web']['valid']==true)
			{
				echo '<div class="right_log">						  
						 		<div class="category_dv" id="profile_Drop">	  
							 <nav>
								<ul>								   
									<li class="dropdown">
										<img class="img_prof" src="'.$_SESSION['session_admin_web']['login_userPhoto'].'" alt=""/>
										<ul class="sub-menu">										   
										<li class="dropdown"> <a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i>
											Setting</a> 
										</li>
										<li class="dropdown"> <a href="approveProducts.php"><i class="material-icons">thumb_up</i>
											Approve Products </a> 
										</li>
										<li class="dropdown"> <a href="approveMessages.php"><i class="material-icons">message</i>
											Approve Messages </a> 
										</li>										
										 <li class="dropdown"> <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
										Logout</a> </li>											
										</ul>
									</li>									 
								</ul>
								</nav>
								</div>
								 
					</div>';
			}
			
		?>
		 
	</div>
	  
	<!--mobile menu-->

	<!--mobile user section-->
	<?php
		if(isset($_SESSION['session_admin_web']['valid']) && $_SESSION['session_admin_web']['valid']==true)
		{
	?>
	<div id="mobile_user">
		<div class="wraper">
			<div class="user_img">
				<?php echo '<img src="'.$_SESSION['session_admin_web']['login_userPhoto'].'" alt="" />' ; ?>
			</div>
				<div class="name1"><?php echo $_SESSION['session_admin_web']['login_userName'] ; ?></div>
		</div>
			<div class="user_menu_li">			
				<ul id="Mobile_li">
				<?php 
				echo '
				<li><a href="settings.php">  <i class="material-icons mob_clr">settings</i> Setting </a></li>
				<li><a href="logout.php">  <i class="material-icons mob_clr">lock_open</i> Logout </a></li>	
					<li class="dropdown"> <a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i>
											Setting</a> 
										</li>
										<li class="dropdown"> <a href="approveProducts.php"><i class="material-icons">thumb_up</i>
											Approve Products </a> 
										</li>
										<li class="dropdown"> <a href="approveMessages.php"><i class="material-icons">message</i>
											Approve Messages </a> 
										</li>	
										';
				?>
				</ul>
			</div>
	</div>
	<?php
		}
	?>
	
	
 	<!--mobile menu-->
  
		</body>
		</html>