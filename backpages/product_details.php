<?php
// Page is included in itemdetail.php 
$method=$_SERVER['REQUEST_METHOD'];
if($method!="GET")
{
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Invalid Request Method. Redirecting Please Wait";
	die;
}

$productId= $_GET['product'];

$sql_query1=mysqli_query($conn,"select * from products where product_id=$productId");
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
	$product_array['product_user_latitude']=$result['lat'];
	$product_array['product_user_longitude']=$result['lng'];
	$product_array['product_location']=$result['location'];
	$product_array['product_id']=$result['product_id'];
	$product_array['product_title']=$result['title'];
	$product_array['product_category']=$result['category'];
	$product_array['product_price']=$result['price'];
	$product_array['product_description']=$result['description'];
	$product_array['product_place']=$result['place'];
	$product_array['product_pro_image']=$result['pro_image'];
	$product_array['product_upload_on']=$result['upload_on'];

	if (isset($_COOKIE["UserLatitude"])){$center_lat= $_COOKIE["UserLatitude"] ;} else { $center_lat="37.386052" ;} 
	if (isset($_COOKIE["UserLongitude"])){$center_lng= $_COOKIE["UserLongitude"] ;} else { $center_lng="-122.083851" ;} 
	if (isset($_COOKIE["UserLocation"])){$location= $_COOKIE["UserLocation"] ;} else { $location="Mountain View, California, United States" ;} 
	// similar products 

	$sql_query6 = mysqli_query($conn,"SELECT * , ( 3959 * acos( cos( radians('$center_lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$center_lng') ) + sin( radians('$center_lat') ) * sin( radians( lat ) ) ) ) AS distance FROM products  HAVING distance < '10' and category='".$result['category']."' and product_id!=$productId order by product_id desc limit 8 ");
					
	$num_rows=mysqli_num_rows($sql_query6);
	if($num_rows!=0)
	{
		$new_array=array("status"=>1,"msg"=>"Product found");
		while($fetch6=mysqli_fetch_array($sql_query6))
		{
			$similar_product_array['product_user_id']=$fetch6['user_id'];
			$sql_query7=mysqli_query($conn,"select * from users where user_id='".$fetch6['user_id']."' ");
			$fetch7=mysqli_fetch_array($sql_query7);
			$similar_product_array['product_username']=$fetch7['username'];
			$similar_product_array['product_userphoto']=$fetch7['userphoto'];
			$similar_product_array['product_user_email']=$fetch7['email'];
			$similar_product_array['product_user_company_name']=$fetch7['company_name'];
			$similar_product_array['product_user_latitude']=$fetch7['lattitude'];
			$similar_product_array['product_user_longitude']=$fetch7['longitude'];
			$similar_product_array['product_location']=$fetch7['location'];
			$similar_product_array['product_id']=$fetch6['product_id'];
			$similar_product_array['product_title']=$fetch6['title'];
			$similar_product_array['product_category']=$fetch6['category'];
			$similar_product_array['product_price']=$fetch6['price'];
			$similar_product_array['product_description']=$fetch6['description'];
			$similar_product_array['product_place']=$fetch6['place'];
			$similar_product_array['product_pro_image']=$fetch6['pro_image'];
			$similar_product_array['product_upload_on']=$fetch6['upload_on'];
			$new_array[]=$similar_product_array;
		}
		$json=array("status"=>1,"msg"=>"Product Details",$product_array,$new_array);
	}
	else
	{
		$new_array=array("status"=>0,"msg"=>"Product not found");
		$json=array("status"=>1,"msg"=>"Product Details",$product_array,$new_array);
	}	
}
else
{
	header('Refresh:1;url='.$url_root.'index.php');
	echo "Sorry! Invalid Request. Redirecting Please Wait...";
	die;
}

/*
echo "<pre>";
print_r($json);
echo "</pre>";
die;
*/

?>