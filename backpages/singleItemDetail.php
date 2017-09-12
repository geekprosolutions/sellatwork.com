<?php
// Page is included in itemdetail.php 
$method=$_SERVER['REQUEST_METHOD'];
if($method!="GET")
{
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Invalid Request Method.Redirecting Please Wait...";
	die;
}
$productId= $_GET['e'];

$sql_query1=mysqli_query($conn,"select * from products where product_id=$productId and user_id='".$_SESSION['session_web']['login_userId']."' ");
$rows=mysqli_num_rows($sql_query1);
if($rows==1)
{
$result =mysqli_fetch_assoc($sql_query1);
$product_array['product_user_id']=$result['user_id'];
$sql_query5=mysqli_query($conn,"select * from users where user_id='".$result['user_id']."' ");
$fetch5=mysqli_fetch_array($sql_query5);
$product_array['product_username']=$fetch5['username'];
$product_array['product_userphoto']=$fetch5['userphoto'];
$product_array['product_user_email']=$fetch5['email'];
$product_array['product_user_company_name']=$fetch5['company_name'];
$product_array['product_user_latitude']=$fetch5['lattitude'];
$product_array['product_user_longitude']=$fetch5['longitude'];
$product_array['product_location']=$fetch5['location'];

$product_array['product_id']=$result['product_id'];
$product_array['product_title']=$result['title'];
$product_array['product_category']=$result['category'];
$product_array['product_price']=$result['price'];
$product_array['product_description']=$result['description'];
$product_array['product_place']=$result['place'];
$product_array['product_pro_image']=$result['pro_image'];
$product_array['product_upload_on']=$result['upload_on'];

$json=array("status"=>1,"msg"=>"Product Details",$product_array);
	
}
else
{
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Invalid Request. Redirecting Please Wait...";
	die;
}
/*
echo "<pre>";
print_r($json);
echo "</pre>";
die;*/


?>