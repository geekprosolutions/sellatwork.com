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
include "backpages/singleItemDetail.php";
$Ad_link="ReviewAd/".$json[0]['product_id']."";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell at Work Online Shopping </title>
<base href="<?php echo $url_root ; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="SellAtWork,SAW, trusted classifieds, safe, buy from co-workers, selling to peers, social shopping, online deals, classifieds, Buy local stuff, Local stuff for sale, Local shopping, Local marketplace, Local yard sales, Local garage sales, Sell locally, Buy locally, Sell stuff at Work, trusted network, no worry buy and sell" />

<!-- **************************** Image Upload Plugin  **************************** -->
<link rel="stylesheet" type="text/css" href="css/imageplugin/font.css" />
<link rel="stylesheet" type="text/css" href="css/imageplugin/picedit.css" />

<!-- **************************** Image Upload Plugin Ends **************************** -->
 
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
  <div class="login-page">
	<div class="Log_mateial_top"></div>	
		<div class="Log_mateial_main" id="Edit_item">
			<div class="login-body log_boxs" style="">
					<div class="account_user" style="line-height: 64px;">
						<i class="material-icons" style="font-size: 33px;">add_shopping_cart</i>
					</div>
					<h3 class="w3ls-title w3ls-title1">Update Product</h3>  
					<br/>
					<form id="form1" action="#" >
								<input type="hidden" value="<?php echo $json[0]['product_id'];?>" id="productId">
								<div class="group">   
									<select name="category" class="select1" id="categories" >
										<?php 
											$option=$json[0]['product_category'];
											if($option!="")
											{
												echo '<option value="'.$option.'" selected style="display:none">'.$option.'</option>';
											}
										?>
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
								  <input type="text" class="user" name="title"placeholder="Title" value="<?php echo $json[0]['product_title'] ;?>"  required id="title" />
								  <span class="highlight"></span>
								</div>
								
								
								 <div class="group">      
								   <input type="text" class="user" name="price"  placeholder="Price" id="item_price" value="<?php echo $json[0]['product_price'] ;?>"  onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" />
								  <span class="highlight"></span>
								</div>
								
								 <div class="group">      
								  <input type="text" class="user" name="description" placeholder="Description" value="<?php echo $json[0]['product_description'] ;?>" id="description"  />
								  <span class="highlight"></span>
								</div>

								<div class="group">   
								 <div class="required"></div>								
								  <input type="text"  class="user location" placeholder="Location" value="<?php echo $json[0]['product_location'] ; ?>" name="location" id="locations" required />
								  <span class="highlight"></span>
								</div>
								
							<input type="submit" value="Update Product " style="width:130px;">
				</form>
				<br/>
				<a href="UpdatePicture/<?php echo $json[0]['product_id']; ?>"><input type="button" value="Update Product Images" style="width:130px;"></a>
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
		var productId=$("#productId").val();
		
			var JSONObj = {
			   "category" :categories,
			   "title"  :title,
			   "price"  :item_price,
			   "description"  :description,
			   "location"  :locations,
			   "product_id"  :productId,
			  
		   };
			var data = JSON.stringify(JSONObj);
			
			$.ajax
			({
				type: 'POST',
				url: 'backpages/edit_product.php',
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
						bootbox.dialog({
						message: '<p class="text-center">'+response.msg+'</p>',
						closeButton: false
						});
						setTimeout(function() {
								window.location.href='<?php echo $Ad_link ; ?>';
								bootbox.hideAll();	
							}, 2000);
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
