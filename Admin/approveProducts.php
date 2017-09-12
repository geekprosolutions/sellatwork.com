<?php 
include "../backpages/connection.php";

if(isset($_SESSION['session_admin_web']['valid']) && $_SESSION['session_admin_web']['valid']==true)
{
	// Get User Details //
	$sql_query1=mysqli_query($conn,"select * from products where approval_status='Not Approved' order by product_id desc");
	$result_rows=mysqli_num_rows($sql_query1);
	if($result_rows==0)
	{
		$json = array("status" => 0, "msg" => "Sorry! No Products Found"); 
	}
	else
	{
		while($result=mysqli_fetch_assoc($sql_query1))
		{
			
			$proinfo['product_id']=$result['product_id'];
			$proinfo['user_id']=$result['user_id'];
			$proinfo['product_title']=$result['title'];
			$proinfo['product_price']=$result['price'];
			$proinfo['product_category']=$result['category'];
			$proinfo['product_image']=$result['pro_image'];
			$proinfo['product_description']=$result['description'];
			$proinfo['product_uploadOn']=$result['upload_on'];
			$proinfo['country']=$result['country'];
			$proinfo['state']=$result['state'];
			$proinfo['city']=$result['city'];
			$proinfo['location']=$result['location'];
			
			
			$query=mysqli_query($conn,"select * from users where user_id='".$result['user_id']."' ") or die(mysqli_error($conn)."Error");
			$query_result_rows=mysqli_fetch_array($query);
			$proinfo['uploaded_by']=$query_result_rows['username'];
			$proinfo['email']=$query_result_rows['email'];
			$proinfo['company_name']=$query_result_rows['company_name'];
			$array[]=$proinfo;
			
			
			
			
		}
		if($result_rows==1){ $result_found="product"; } else{ $result_found="products"; }
		$json = array("status" => 1, "msg" => "  <b> $result_rows </b> $result_found ","rows"=>$result_rows,$array);
	}
}
else
{
	header('Refresh:1;url='.$url_root.'/admin/login.php');
	echo "Unauthorized Access! Please Login To Begin. Redirecting Please Wait...";
	die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell at Work Products Inbox </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="SellAtWork,SAW, trusted classifieds, safe, buy from co-workers, selling to peers, social shopping, online deals, classifieds, Buy local stuff, Local stuff for sale, Local shopping, Local marketplace, Local yard sales, Local garage sales, Sell locally, Buy locally, Sell stuff at Work, trusted network, no worry buy and sell" />
<!-- Custom Theme files -->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="../css/menu.css" rel="stylesheet" type="text/css" media="all" /> <!-- menu style --> 
<link href="../css/ken-burns.css" rel="stylesheet" type="text/css" media="all" /> <!-- banner slider --> 
<link href="../css/animate.min.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="../css/owl.carousel.css" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->
<link href="../css/font-awesome.css" rel="stylesheet"> 
<link href="styles.css" rel="stylesheet" type="text/css" media="all" /> 
<link rel="stylesheet" href="../css/jquery_ui.css">  
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
<script src="../js/jquery-2.2.3.min.js"></script> 
<script src="../js/range_slider/jquery_ui.js"></script>
<script src="../js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/alertify/alertify.min.js"></script>
<link rel="stylesheet" href="../css/alertify/alertify.min.css"/>		 

  
 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</head>
<body>
<div id="My_conatiner" style="background-color:#fff;"> 
<!-- Header starts -->
<?php include "header.php" ;?>
<!--Header Ends -->		 
		  <div class="margin_top" style="padding-top:3em;"></div>
		
		<div class="clear"></div>
		<div id="inbox">    
		 	<div class="Prod_wrape" id="mylist">
				 <?php 
					if($json['status']==0)
					{
						echo '<div class="info512"><h1 class="result_found"> Sorry! No Result Found </h1> </div>'; 
					}
					
					elseif($json['status']==1)
					{
						echo '<div class="Prod_head1">
								<h1 class="serach">'.$json['msg'].'</h1>
								<div class="back"><a href="adminPanel.php"> << Home </a></div>
							</div>';
				?>
					<div class="Prod_des">
						  <div class="wraper">
						 <?php		
								for($i=0;$i<$json['rows'];$i++)
								{
									$images=explode(",",$json[0][$i]['product_image']);
									foreach($images as $image)
									{
										if($image!="" || $image!=" ")
										{
											$product_pic=$image;
										}
									}
									
									$price = $json[0][$i]['product_price'];
									if($price=="0" || $price=="" || $price=="Not Available")
									{
										$price =" Free ";
									}
									elseif($price=="Best Offer")
									{
										$price =" Best Offer ";
									}
									else
									{
										$price = "$ ".$json[0][$i]['product_price'];
									}	
									
									echo '<div class="inbox_wrape">										 
												 <a href="">
												    <div class="col-lg-2 col-lg-offset-0 col-xs-12 col-xs-offset-0 col-md-2 col-md-offset-0 col-sm-offset-0 col-sm-3   rt_br">   
														<img src="'.$product_pic.'" style="width:140px; height:140px;" />
													</div>	
												  </a>
												<div class="col-lg-6 col-xs-12 col-md-5 col-sm-offset-0 col-sm-12"> 
													<div class="left">
														<a href="#"><div class="prod_title"> '.$json[0][$i]['product_title'].' </div></a>
														 <div class="upload">
															<span style="color:#808080;"> '.$json[0][$i]['product_description'].' </span> 
														</div>
														 <div class="upload">
														 Uploaded On:  
															<span style="color:#808080;"> '.$json[0][$i]['product_uploadOn'].' </span> 
														</div>
														 <div class="upload">
														  Location :  
															<span style="color:#808080;"> '.$json[0][$i]['location'].' </span> 
														</div> 
														<div class="upload">
														  Uploaded by  :  
															<span style="color:#808080;"> '.$proinfo['uploaded_by'].' </span> 
														</div>
														<div class="upload">
														  Email  :  
															<span style="color:#808080;"> '.$proinfo['email'].' </span> 
														</div>
														<div class="upload">
														  Company name :  
															<span style="color:#808080;"> '.$proinfo['company_name'].' </span> 
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 col-xs-offset-0">
													<div class="right">	
														<span class="price">'.$price.' </span> 
													 <span class="category">
														<i class="fa fa-tags" aria-hidden="true"></i>  '.$json[0][$i]['product_category'].' 
													 </span>
													 <span>
														<button type="button" class="btn btn-primary" onclick="approveProduct('.$json[0][$i]['product_id'].')">Approve</button>
													 </span>
													</div>
												</div>											 
											</div>';							
								}
							?>				 
						</div>		  
					</div>	
			<?php 
				}
			?>
		</div>	  
 </div>
 

	<!--=======Head  end=======-->
  <div class="clear"></div>
	
	<!-- Loader Begins -->
		<div id="ark_loader" class="ark_loader" style="display:none" >
			<span>
				<span class="innerLdr"><img src="../img/loading.gif" style="height:150px" ></span>
			</span>
		</div>
	<!-- Loader Ends -->							 

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
function approveProduct(proid)
{	
	$("#ark_loader").css("display","block");
	var data ={"Action":"approveProduct","product_id" : proid};
	$.ajax
	({
		url : 'handleRequests.php',
		type : 'post',
		data : data,
		success : function(response)
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
						location.reload(true);
						bootbox.hideAll();
					}, 2000);
			}
		}
	});
}
</script>