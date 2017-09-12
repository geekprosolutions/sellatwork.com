<?php
include "backpages/connection.php";
include "backpages/userinfo.php"; // get userdetails
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell at Work Settings </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="SellAtWork,SAW, trusted classifieds, safe, buy from co-workers, selling to peers, social shopping, online deals, classifieds, Buy local stuff, Local stuff for sale, Local shopping, Local marketplace, Local yard sales, Local garage sales, Sell locally, Buy locally, Sell stuff at Work, trusted network, no worry buy and sell" />
<!-- Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/tabs.css" rel="stylesheet" type="text/css"> 
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
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/jquery_ui.css">
<script src="js/range_slider/jquery_ui.js"></script>
<script src="js/owl.carousel.js"></script> 
<script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script> 
<script src="js/bootstrap.js"></script>	
<script src="js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="css/alertify/alertify.min.css"/>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
  
</head>
<body>
<div id="My_conatiner" style="padding:0 !important;">
<!-- Header starts -->
<?php include "header.php" ;?>
<!--Header Ends -->	
	<div class="margin_top" style="padding-top:3em;"></div>
	<?php 
	  if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
	  {
		  if(isset($_SESSION['session_web']['login_userVerified']) && $_SESSION['session_web']['login_userVerified']=="Not Verified")
		  {
			echo'<div class="col-md-12" style="background-color: #f06966;min-height:30px;max-height:65px;">
					<span style="font-weight: normal;font-family:Rubik,sans-serif !important;color: #454545;font-size:15px;line-height:30px; ">
						<center> Please Check Your Mail to Verify Your Account </center>
					</span>
			   </div>';
		  }
		  else
		  {
			  if(isset($_SESSION['session_web']['login_userCompanyVerified']) && $_SESSION['session_web']['login_userCompanyVerified']=="Not Verified")
			  {
				  echo'<div class="col-md-12" style="background-color: #f06966;min-height:30px;max-height:65px;">
							<span style="font-weight: normal;font-family:Rubik,sans-serif !important;color: #454545;font-size:15px;line-height:30px; ">
								<center> Please <a href="verification.php" style="color:white">Verify </a> Your Company to post an Ad or Contact anyone.  </center>
							</span>
					   </div>';
			  }
		  }
	  } 
	?>	
  <div class="clear"></div>  
  <div class="login-page add_pro_bg">
		<div class="container"> 
			<h3 class="w3ls-title w3ls-title1 setting_h3">Update Profile</h3>  			
			<div class="login-body opc_bg">
					<div class="col-md-12 pd_left">
					<div class="Upload_img">
						<div class="col-sm-2 pd_left"><img class="img-circle" id="avatar-edit-img" height="128" data-src="<?php echo $json[0]['userphoto'] ;?>"  data-holder-rendered="true" style="width: 120px; height: 120px;" src="<?php echo $json[0]['userphoto'] ;?>"/></div>
						<div class="col-sm-8"><a type="button" class="edit_pic" id="change-pic" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Change Image</a></div>
					</div>
					</div>
					<!-- Pop up Modal -->
					<div id="myModal" class="modal fade" role="dialog">
					  <div class="modal-dialog">
						  <div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" onclick="closeModal()">&times;</button>
								<h4 class="modal-title">Setting</h4>
							  </div>
							  <div class="modal-body">
								<form id="cropimage" method="post" enctype="multipart/form-data" action="backpages/profile_pic.php">
								<div class="model_wrape">
									<div class="model_lbl">Upload your image</div>
									<input type="file" name="photoimg" id="photoimg" />
									<input type="hidden" name="hdn-profile-id" id="hdn-profile-id" value="<?php echo $json[0]['user_id'] ;?>" />
									<input type="hidden" name="hdn-x1-axis" id="hdn-x1-axis" value="" />
									<input type="hidden" name="hdn-y1-axis" id="hdn-y1-axis" value="" />
									<input type="hidden" name="hdn-x2-axis" value="" id="hdn-x2-axis" />
									<input type="hidden" name="hdn-y2-axis" value="" id="hdn-y2-axis" />
									<input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
									<input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
									<input type="hidden" name="action" value="" id="action" />
									<input type="hidden" name="image_name" value="" id="image_name" />
									
									<div id='preview-avatar-profile'>
									</div>
								<div id="thumbs" style="padding:5px; width:100%"></div>
								</form>
								  
								</div>
							  </div>
							  <div class="modal-footer">
							    <button type="button" id="btn-crop" class="btn btn-primary" data-dismiss="modal" >Crop & Save</button>
							  </div>
						   </div>
						</div>
					</div>
					<!-- Pop up Modal Ends -->
					<div class="clear"></div>
				
					  <div id="tabs">
							  <ul>
								<li style="margin-left:8px" ><a href="#tabs-1">Basic Information</a></li>
								<li style="margin-left:8px"><a href="#tabs-2">Change Password</a></li>    
							  </ul>
							  <form action="#" method="post" id="form1">
							  <div id="tabs-1">
							  <div class="tabs_main">
							    
								 <div class="group">      
								 <input type="text" placeholder="Enter your name" class="user" name="username"  readonly value="<?php echo $json[0]['username'] ;?>"   id="username" required>
									<span id="nameError"  class="error"></span> 
								  
								</div>
								
								 <div class="group">      
									<input type="email" placeholder="Enter your Email"  class="user setting_mail" name="email" value="<?php echo $json[0]['email'] ;?>"   id="email" required>
									<span id="emailError" class="error"></span> 
								</div>
							<!--	<div class="group">      
									<input type="text" placeholder="Enter your Company Name"  class="user setting_mail" name="company_name" value="<?php //echo $json[0]['company_name'] ;?>"   id="company_name" required>
								</div> -->
								
								 <div class="group"> 
									 <input type="text"  class="user location" placeholder=""  name="location" value="<?php echo $json[0]['location'] ;?>" id="locations" required />
								</div>
								
									<input type="submit" value="Update ">
								</div>
							  </div>
							  </form>
							  <form action="#" method="post" id="form2">
							  <div id="tabs-2">
							   <div class="tabs_main">
							   
							    <div class="group">   
									<input type="password" name="oldpwd" class="lock"  id="oldpwd" required>						 
									<span id="emailError" class="error"></span> 
								  <span class="highlight"></span>
								  <label>Old Password</label>
								</div>
								 
								<div class="group">   
									<input type="password"  name="newPwd"  id="newPwd" required />						 
								  <span class="highlight"></span>
								  <label>New Password</label>
								</div>
									
								 <div class="group">   
									<input type="password"  name="confirmPwd" id="confirmPwd" required />
									<span id="pwdError" class="error error_pwd"></span>						 
								  <span class="highlight"></span>
								  <label>Confirm Password</label>
								</div>
								 
								 <input type="submit" value="Update ">
							  </div>  
							  </div>
							  </form>
					 </div>
					
				
			</div>  
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
</script> 


<script>
$(document).ready(function()
{
	//Submit Basic Information
	$("#form1").on("submit",function(e)
	{
		e.preventDefault();
		$("#ark_loader").css("display","block");
		var username=$("#username").val();
		var email=$("#email").val();
		var company_name=$("#company_name").val();
		var locations=$("#locations").val();
		
		
			var JSONObj = {
			   "username" :username,
			   "email"  :email,
			   "company_name"  :company_name,
			   "location" :locations,
			   "info" : "basic",
		   };
			var data = JSON.stringify(JSONObj);
			
			$.ajax
			({
				type: 'POST',
				url: 'backpages/updateApi.php',
				data: data,
				success: function(response) 
				{
					//alert(JSON.stringify(response));
					if(response.status==0)
					{
						$("#nameError").html(response.nameError);
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
						$("#nameError").html(response.nameError);
						$("#emailError").html(response.emailError);
						bootbox.dialog({
						message: '<p class="text-center">'+response.msg+'</p>',
						closeButton: false
						});
						setTimeout(function() {
							  window.location.href = "settings.php";
								bootbox.hideAll();
							}, 2000);
					}
					
				}
			});
		});
	
	//Submit Password Information
	$("#form2").on("submit",function(e)
	{
		e.preventDefault();
		$("#ark_loader").css("display","block");
		var oldpwd=$("#oldpwd").val();
		var newpwd=$("#newPwd").val();
		var confirmPwd=$("#confirmPwd").val();
		
		if(newpwd!=confirmPwd)
		{
			$("#pwdError").html("* Password Does not match");
			$("#ark_loader").css("display","none");
		}
		else
		{
			$("#pwdError").html("");
			
			var JSONObj = {
			   "oldpwd"  :oldpwd,
			   "newpwd"  :newpwd,
			   "confirmPwd"  :confirmPwd,
			   "info" : "secret",
		   };
			var data = JSON.stringify(JSONObj);
			
			
			$.ajax
			({
				type: 'POST',
				url: 'backpages/updateApi.php',
				data: data,
				success: function(response) 
				{
					//alert(JSON.stringify(response));
					if(response.status==0)
					{
						$("#oldPwdError").html(response.oldPwdError);
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
						$("#oldPwdError").html(response.oldPwdError);
						bootbox.dialog({
						message: '<p class="text-center">'+response.msg+'</p>',
						closeButton: false
						});
						setTimeout(function() {
								window.location.href = "login.php";
								bootbox.hideAll();
							}, 2000);
					}
					
				}
			});
		}
	});
	
});
</script>
<!-- Profile image -->
<script type="text/javascript">

  function closeModal()
  {
	$("#cropimage").trigger("reset");
	$("#preview-avatar-profile").html("");
	$(".imgareaselect-selection").parent().css("display","none");
	$(".imgareaselect-outer").css("display","none");
  }  

jQuery(document).ready(function()
{


jQuery('#photoimg').on('change', function()   
{ 
	jQuery("#preview-avatar-profile").html('');
	jQuery("#preview-avatar-profile").html('Uploading....');
	jQuery("#cropimage").ajaxForm(
	{
	target: '#preview-avatar-profile',
	success:    function() { 
			jQuery('img#photo').imgAreaSelect({
			aspectRatio: '1:1',
			onSelectEnd: getSizes,
		});
		jQuery('#image_name').val(jQuery('#photo').attr('file-name'));
		}
	}).submit();

});

jQuery('#btn-crop').on('click', function(e)
{
$("#ark_loader").css("display","block");
$(".imgareaselect-selection").parent().css("display","none");
$(".imgareaselect-outer").css("display","none");

e.preventDefault();
params = {
		targetUrl: 'backpages/profile_pic.php?action=save',
		action: 'save',
		x_axis: jQuery('#hdn-x1-axis').val(),
		y_axis : jQuery('#hdn-y1-axis').val(),
		x2_axis: jQuery('#hdn-x2-axis').val(),
		y2_axis : jQuery('#hdn-y2-axis').val(),
		thumb_width : jQuery('#hdn-thumb-width').val(),
		thumb_height:jQuery('#hdn-thumb-height').val()
	};

	saveCropImage(params);
});



function getSizes(img, obj)
{
	var x_axis = obj.x1;
	var x2_axis = obj.x2;
	var y_axis = obj.y1;
	var y2_axis = obj.y2;
	var thumb_width = obj.width;
	var thumb_height = obj.height;
	if(thumb_width > 0)
		{

			jQuery('#hdn-x1-axis').val(x_axis);
			jQuery('#hdn-y1-axis').val(y_axis);
			jQuery('#hdn-x2-axis').val(x2_axis);
			jQuery('#hdn-y2-axis').val(y2_axis);
			jQuery('#hdn-thumb-width').val(thumb_width);
			jQuery('#hdn-thumb-height').val(thumb_height);
			
		}
	else
		alert("Please select portion..!");
}

function saveCropImage(params) {
jQuery.ajax({
	url: params['targetUrl'],
	cache: false,
	dataType: "html",
	data: {
		action: params['action'],
		id: jQuery('#hdn-profile-id').val(),
		 t: 'ajax',
		w1:params['thumb_width'],
		x1:params['x_axis'],
		h1:params['thumb_height'],
		y1:params['y_axis'],
		x2:params['x2_axis'],
		y2:params['y2_axis'],
		image_name :jQuery('#image_name').val()
	},
	type: 'Post',
	success: function (response) 
	{
			$("#ark_loader").css("display","block");			
			bootbox.dialog({
			message: '<p class="text-center">Picture Updated</p>',
			closeButton: false
			});
			setTimeout(function() {
					window.location.href = "settings.php";
					bootbox.hideAll();
				}, 2000);
	},
		error: function (xhr, ajaxOptions, thrownError) {
		$("#ark_loader").css("display","none");
		alert('status Code:' + xhr.status + 'Error Message :' + thrownError);
	}
});
}
});
</script>