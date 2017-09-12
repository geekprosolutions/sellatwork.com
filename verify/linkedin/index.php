<?php
include "../../backpages/connection.php";
@session_start();
if(isset($_SESSION["loggedin_user_id"]) && !empty($_SESSION["user"])) 
{
	$Return=array("error"=>"","result"=>"","location"=>"");
	$userid=$_SESSION['loggedin_user_id'];
	//$_SESSION['loggedin_reg_email'];
	$reg_email=$_SESSION['linked_in_email'];
	$reg_company=$_SESSION['linked_in_company'];
	
	
	// Check for email Validation
	$trim_email=explode("@",$reg_email);
	$domain=$trim_email[1];
	if(empty($reg_company))
	{
		$Return['error']="Company name could not be verified via LinkedIn. Please enter you company email address to verify.";
		$Return['location']="../../verification.php";
	}
	else
	{
		$whitelist=1;
		$sql_query2=mysqli_query($conn,"update users set company_name='$reg_company',whitelist=$whitelist,company_verification_code='Verified via Linkedin',company_verified='Verified' where user_id='".$userid."' ") or die(mysqli_error($conn)."error");
		if($sql_query2)
		{
			$Return['result']= "Company Verified successfully";
			$_SESSION['session_web']['login_userCompanyVerified']="Verified";
			$Return['location']="../../index.php";
		}
	}

}
else
{	
	if(isset($_SESSION["err_msg"]) && $_SESSION["err_msg"] <> "")
	{
		$_SESSION['login_status']=false;
		$_SESSION['login_error']=$_SESSION["err_msg"];
	}
	header('Location:process.php');
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
<meta name="keywords" content="Smart Bazaar Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- Custom Theme files -->
<!-- CSS dependencies -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- JS dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- bootbox code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<style> 
.ark_loader{
background-color:transparent;
opacity: 0.8;
padding: 3px 7px;
position: fixed;
bottom: 0px;
width: 100%;
	height: 100%;
	z-index: 150;
	color: #FFF;
 text-align: center;
 left: 0;
}
.ark_loader  .innerLdr{
margin-right: 4px;

} 
#ark_loader > span {
    left: 50%;
    position: fixed;
    top: 50%;
    transform: translate(-50%, -50%);
}
</style>
<body>
<!-- Loader Begins -->
<div id="ark_loader" class="ark_loader" style="display:none" >
	<span>
		<span class="innerLdr"><img src="../../img/loading.gif" style="height:150px" ></span>
	</span>
</div>
<!-- Loader Ends -->
</body>
</html>
<script>
var red_location='<?php echo $Return['location']; ?>';
var error='<?php echo $Return['error']; ?>';
var result='<?php echo $Return['result']; ?>';
//alert("location "+ red_location + " , error "+ error +" result "+ result);

if(error!="")
{
	$("#ark_loader").css("display","block");
	bootbox.dialog({
	message: '<p class="text-center">'+error+'</p>',
	closeButton: false
	});
	setTimeout(function() {
			window.location.href=red_location;
		}, 3000);
}
else
{
	$("#ark_loader").css("display","block");
	bootbox.dialog({
	message: '<p class="text-center">'+result+'</p>',
	closeButton: false
	});
	setTimeout(function() {
			window.location.href=red_location;
		}, 3000);
}
</script>