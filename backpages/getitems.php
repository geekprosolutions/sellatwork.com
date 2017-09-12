<?php
include_once 'connection.php' ;
$method = $_SERVER['REQUEST_METHOD']; 
if($method == "GET")
{
		// Get parameters from URL
		$key=$_GET['key'];
		$filter_key=$_GET['e'];
		$category=$filter_key;
		if($key=="cat")
		{
			
			// Search the rows in  table
			$lat=isset($_COOKIE["UserLatitude"]) ?  $_COOKIE["UserLatitude"] : "37.386052";
			$lng=isset($_COOKIE["UserLongitude"]) ? $_COOKIE["UserLongitude"] : "-122.083851";
			
			$radius="50";
			
			if($lat=="" || $lng=="")
			{
				$sql_query = mysqli_query($conn,"SELECT * from products where category='$category' order by product_id desc");
			}
			else
			{
				$sql_query = mysqli_query($conn,"SELECT * , ( 3959 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance FROM products  HAVING distance < '$radius'  and category='$category' order by product_id desc") or die(mysqli_error($conn)."error");
			}
			

			if(!$sql_query)
			{
				$json = array("status" => 0, "msg" => "Error in sql Query");
			}
			else
			{
				
				// Iterate through the rows 
				$product_arraylist['product_list']=array(); // Array to hold products
				$result_rows=mysqli_num_rows($sql_query);
				if($result_rows==0)
				{
					$json = array("status" => 0, "msg" => "Sorry! No record found for \" <b> $category </b> \" ","rows"=>$result_rows);
				}
				else
				{
					while ($result =mysqli_fetch_assoc($sql_query))
					{
						$product_array['product_user_id']=$result['user_id'];
						$sql_query5=mysqli_query($conn,"select * from users where user_id='".$result['user_id']."' ");
						$fetch5=mysqli_fetch_array($sql_query5);
						$product_array['product_username']=$fetch5['username'];
						$product_array['product_userphoto']=$fetch5['userphoto'];
						$product_array['product_user_email']=$fetch5['email'];
						$product_array['product_user_company_name']=$fetch5['company_name'];
						$product_array['product_id']=$result['product_id'];
						$product_array['product_title']=$result['title'];
						$product_array['product_category']=$result['category'];
						$product_array['product_price']=$result['price'];
						$product_array['product_description']=$result['description'];
						$product_array['product_location']=$result['location'];
						$product_array['product_place']=$result['place'];
						$product_array['product_pro_image']=$result['pro_image'];
						$product_array['product_upload_on']=$result['upload_on'];
						
						array_push($product_arraylist['product_list'],$product_array);
					}
					if($result_rows==1){ $result_found="result found for "; } else{ $result_found="results were found for"; }
					$json = array("status" => 1, "msg" => "<b> $result_rows </b> $result_found  <b> $category </b> ","rows"=>$result_rows,$product_arraylist); 
				}
			}
		}
		
		// location based search 
		elseif($key=="location")
		{
			$location=$filter_key;
			
			
			$sql_query = mysqli_query($conn,"SELECT * from products where location like'%$location%' order by product_id desc");
			if(!$sql_query)
			{
				$json = array("status" => 0, "msg" => "Error in sql Query");
			}
			else
			{
				
				// Iterate through the rows 
				$product_arraylist['product_list']=array(); // Array to hold products
				$result_rows=mysqli_num_rows($sql_query);
				if($result_rows==0)
				{
					$json = array("status" => 0, "msg" => "Sorry! No record found ","rows"=>$result_rows);
				}
				else
				{
					while ($result =mysqli_fetch_assoc($sql_query))
					{
						$product_array['product_user_id']=$result['user_id'];
						$sql_query5=mysqli_query($conn,"select * from users where user_id='".$result['user_id']."' ");
						$fetch5=mysqli_fetch_array($sql_query5);
						$product_array['product_username']=$fetch5['username'];
						$product_array['product_userphoto']=$fetch5['userphoto'];
						$product_array['product_user_email']=$fetch5['email'];
						$product_array['product_user_company_name']=$fetch5['company_name'];
						$product_array['product_id']=$result['product_id'];
						$product_array['product_title']=$result['title'];
						$product_array['product_category']=$result['category'];
						$product_array['product_price']=$result['price'];
						$product_array['product_description']=$result['description'];
						$product_array['product_location']=$result['location'];
						$product_array['product_place']=$result['place'];
						$product_array['product_pro_image']=$result['pro_image'];
						$product_array['product_upload_on']=$result['upload_on'];
						
						array_push($product_arraylist['product_list'],$product_array);
					}
					if($result_rows==1){ $result_found="result found for "; } else{ $result_found="results were found for"; }
					$json = array("status" => 1, "msg" => "<b> $result_rows </b> $result_found  <b> $category </b> ","rows"=>$result_rows,$product_arraylist); 
				}
			}
		}
		
		// location based search 
		elseif($key=="company")
		{
			$company=$filter_key;
			
			
			$lat=isset($_COOKIE["UserLatitude"]) ?  $_COOKIE["UserLatitude"] : "37.386052";
			$lng=isset($_COOKIE["UserLongitude"]) ? $_COOKIE["UserLongitude"] : "-122.083851";
			
			$radius="50";
			
			if($lat=="" || $lng=="")
			{
				$sql_query = mysqli_query($conn,"SELECT * from products where company_name like'%$company%' order by product_id desc");
			}
			else
			{
				$sql_query = mysqli_query($conn,"SELECT * , ( 3959 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance FROM products  HAVING distance < '$radius'  and company_name like'%$company%' order by product_id desc") or die(mysqli_error($conn)."error");
			}
			
			
			if(!$sql_query)
			{
				$json = array("status" => 0, "msg" => "Error in sql Query");
			}
			else
			{
				
				// Iterate through the rows 
				$product_arraylist['product_list']=array(); // Array to hold products
				$result_rows=mysqli_num_rows($sql_query);
				if($result_rows==0)
				{
					$json = array("status" => 0, "msg" => "Sorry! No record found ","rows"=>$result_rows);
				}
				else
				{
					while ($result =mysqli_fetch_assoc($sql_query))
					{
						$product_array['product_user_id']=$result['user_id'];
						$sql_query5=mysqli_query($conn,"select * from users where user_id='".$result['user_id']."' ");
						$fetch5=mysqli_fetch_array($sql_query5);
						$product_array['product_username']=$fetch5['username'];
						$product_array['product_userphoto']=$fetch5['userphoto'];
						$product_array['product_user_email']=$fetch5['email'];
						$product_array['product_user_company_name']=$fetch5['company_name'];
						$product_array['product_id']=$result['product_id'];
						$product_array['product_title']=$result['title'];
						$product_array['product_category']=$result['category'];
						$product_array['product_price']=$result['price'];
						$product_array['product_description']=$result['description'];
						$product_array['product_location']=$result['location'];
						$product_array['product_place']=$result['place'];
						$product_array['product_pro_image']=$result['pro_image'];
						$product_array['product_upload_on']=$result['upload_on'];
						
						array_push($product_arraylist['product_list'],$product_array);
					}
					if($result_rows==1){ $result_found="result found for "; } else{ $result_found="results were found for"; }
					$json = array("status" => 1, "msg" => "<b> $result_rows </b> $result_found  <b> $category </b> ","rows"=>$result_rows,$product_arraylist); 
				}
			}
		}
}
else
{
	$json = array("status" => 0, "msg" => "Invalid Response"); // If Response Method is not Post
}
		

$file = fopen("category_items.json", "w") or die("Unable to open file!");
$txt = json_encode($json);
chmod("category_items.json",0777);
fwrite($file, $txt);
fclose($file); 
//echo json_encode($json);

if($key=="cat")
{
	$filter_key=str_replace(" ","",$_GET['e']);		
	header('Location:../Category/'.$filter_key);
}
elseif($key=="location")
{
	$filter_key=str_replace(" ","",$_GET['e']);	
	header('Location:../Location/'.$filter_key);
}
elseif($key=="company")
{
	$filter_key=str_replace(" ","",$_GET['e']);
	header('Location:../Company/'.$filter_key);
}

?>

