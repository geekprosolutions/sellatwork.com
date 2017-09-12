<?php
include "backpages/connection.php" ;
if(!isset($_SESSION['session_web']['valid']) || $_SESSION['session_web']['valid']!=true  )
{
	header('Refresh:1;url='.$url_root.'login.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait... ";
	die;
}
elseif(!isset($_SESSION['session_web']['login_userVerified']) || $_SESSION['session_web']['login_userVerified']!="Verified" || !isset($_SESSION['session_web']['login_userCompanyVerified']) || $_SESSION['session_web']['login_userCompanyVerified']!="Verified")
{	
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Unauthorized Access! Please Verify Your Account. Redirecting Please Wait...";
	die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> Post New Ad - SellAtWork.com  </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="SellAtWork,SAW, trusted classifieds, safe, buy from co-workers, selling to peers, social shopping, online deals, classifieds, Buy local stuff, Local stuff for sale, Local shopping, Local marketplace, Local yard sales, Local garage sales, Sell locally, Buy locally, Sell stuff at Work, trusted network, no worry buy and sell />
 
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
<!-- js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link rel="icon" type="image/png" href="favicon.ico">
<!-- //js --> 
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!--range slider-->
<link rel="stylesheet" href="css/jquery_ui.css">
<script src="js/range_slider/jquery_ui.js"></script>
<!-- **************************** Alertify **************************** -->
<script src="js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="css/alertify/alertify.min.css"/>
<!-- **************************** Alertify Ends **************************** -->
<script src="js/owl.carousel.js"></script>
<script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>

</head>
<body class="banner1">
<div id="My_conatiner">
<!-- Header starts -->
<?php include "header.php" ;?>
<!--Header Ends -->		
  <div class="login-page" style="margin-bottom:5em;">
	<div class="Log_mateial_top"></div>	
		<div class="Log_mateial_main">
			<div class="login-body log_boxs" style="">
					<div class="account_user" style="line-height: 64px;">
						<i class="material-icons" style="font-size: 33px;">add_shopping_cart</i>
					</div>
					<h3 class="w3ls-title w3ls-title1">Add Products</h3>  
					<br/>
					<form id="form1" action="#" >
								
								<div class="group">  
								 							
									<select name="category" class="select1" id="categories" >
										<option value="Furniture">Furniture</option>
										<option value="Baby Items">Baby Items</option>
										<option value="Housing">Housing</option>
										<option value="Electronics">Electronics</option>
										<option value="eGarage-Sales">eGarage-Sales</option>
										<option value="Other">Other</option>
										<option value="Free">Free</option>
										<option value="Bikes and Autos">Bikes and Autos</option>
									</select>
									<span class="select_ico"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
								</div>	
							  <div class="group">   
									<div class="required"></div>
								  <input type="text" class="user" name="title" placeholder="Title"  required id="title" />
								  <span class="highlight"></span>
								  
								</div>
								 
								 <div class="group">   
									<input type="text" class="user add" name="price" placeholder="Price"  id="item_price" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"/>
								  <span class="highlight"></span>
								  
								</div>
								
								 <div class="group">  
								 
								  <textarea class="user add text_add" name="description" placeholder="Description"  id="description"/></textarea>
								  <span class="highlight"></span>
								  
								</div>

								<div class="group"> 
									<div class="required"></div>
								  <input type="text"  class="user location" placeholder="Location" value="<?php if (isset($_COOKIE["UserLocation"])){ echo  $_COOKIE["UserLocation"] ;} else { echo "Mountain View, California, United States";}  ?>" name="location"  id="locations" required />
								  <span class="highlight"></span>
								  
								</div>
								
								 
							  
							<input type="submit" value="Add Product " style="width:130px;">
				</form>
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

<script>
$(document).ready(function()
{

	//var root_url='<?php echo $url_root ; ?>';
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
			return true;
	}

	$("#form1").on("submit",function(e)
	{
		e.preventDefault();
		$("#ark_loader").css("display","block");
		
		var categories=$("#categories").val();
		var item_price=$("#item_price").val();
		var title=$("#title").val();
		var description=$("#description").val();
		var locations=$("#locations").val();
		
			var JSONObj = {
			   "category" :categories,
			   "title"  :title,
			   "price"  :item_price,
			   "description"  :description,
			   "location"  :locations,
			  
		   };
			var data = JSON.stringify(JSONObj);
			
			
			$.ajax
			({
				type: 'POST',
				url: 'backpages/add_new_product.php',
				data: data,
				success: function(response) 
				{
					//alert(JSON.stringify(response));
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
						window.location.href = "add_photos.php" ;
					}
					
				}
			});
		
	});
	
	
});
</script>
 
<!-- *************** Location Finder *************** -->
<script src="UserLocationScript.js"> </script>
<!-- *************** Location Finder  *************** -->
</script>  
