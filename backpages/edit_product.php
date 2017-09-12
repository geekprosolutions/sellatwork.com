<?php
include "connection.php";
include "userinfo.php";
$_POST = json_decode(file_get_contents('php://input'), true);
$method = $_SERVER['REQUEST_METHOD']; 
if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
{
	if($method=="POST")
	{
			// get username and userid from session 
			$username=$_SESSION['session_web']['login_userName'];
			$userId=$_SESSION['session_web']['login_userId'];

			// Validate data
			function test_input($data) 
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}	
			
			$category=$_POST['category'];
			$company_name=$json[0]['company_name'];
			$title=test_input($_POST['title']);
			if(isset($_POST['price']) && !empty($_POST['price']))
			{
				$price=$_POST['price'];
			}
			else
			{
				$price="Best Offer";
			}
			if(isset($_POST['description']) && !empty($_POST['description']))
			{
				$description=mysqli_real_escape_string($conn,$_POST['description']);
			}
			else
			{
				$description="Not Available";
			}
			
			
			$location=test_input($_POST['location']);
			$product_id=test_input($_POST['product_id']);
			
		
			$Address = urlencode($location);
			$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
			$xml = simplexml_load_file($request_url) or die("url not loading");

			$status = $xml->status;
			if ($status=="OK") 
			{
			  $lat = $xml->result->geometry->location->lat;
			  $lng = $xml->result->geometry->location->lng;
			}
			else
			{
			   $lat=isset($_COOKIE["UserLatitude"]) ?$_COOKIE["UserLatitude"] : "37.386052";
			   $lng=isset($_COOKIE["UserLongitude"]) ? $_COOKIE["UserLongitude"] : "-122.083851";
			}
			
			$sql=mysqli_query($conn,"select * from categories where category_name='$category' ") or die(mysqli_error($conn)."ERROR");
			$fetch=mysqli_fetch_array($sql);
			$imagepath=$fetch['category_picture'];
			
			$sql1=mysqli_query($conn,"select * from products where product_id=$product_id and user_id='$userId' ") or die(mysqli_error($conn)."error");
			$rows=mysqli_num_rows($sql1);
			if($rows==1)
			{
				$result=mysqli_fetch_array($sql1);
				$proImages=explode(",",$result['pro_image']);
				if(count($proImages)<=1)
				{
					if(strpos($result['pro_image'],'Categories') !== false) 
					{
						//Update data into database 
						$sql_query1=mysqli_query($conn,"update products set title='$title',category='$category',price='$price',description='$description',location='$location',lat='$lat',lng='$lng',pro_image='$imagepath' where product_id=$product_id and user_id='$userId' ");
						if($sql_query1)
						{
							$json = array("status" => 1, "msg" => "Product Updated Successfully"); // Successfull Message
						}
						else
						{
							$json = array("status" => 0, "msg" => "Something Went Wrong"); // Data Entry Not Successfull
						}
					}
					else
					{
						//Update data into database 
						$sql_query1=mysqli_query($conn,"update products set title='$title',category='$category',price='$price',description='$description',location='$location',lat='$lat',lng='$lng' where product_id=$product_id and user_id='$userId' ");
						if($sql_query1)
						{
							$json = array("status" => 1, "msg" => "Product Updated Successfully"); // Successfull Message
						}
						else
						{
							$json = array("status" => 0, "msg" => "Something Went Wrong"); // Data Entry Not Successfull
						}
					}
				}
				else
				{
					//Update data into database 
					$sql_query1=mysqli_query($conn,"update products set title='$title',category='$category',price='$price',description='$description',location='$location',lat='$lat',lng='$lng' where product_id=$product_id and user_id='$userId' ");
					if($sql_query1)
					{
						$json = array("status" => 1, "msg" => "Product Updated Successfully"); // Successfull Message
					}
					else
					{
						$json = array("status" => 0, "msg" => "Something Went Wrong"); // Data Entry Not Successfull
					}
				}
			}
			else
			{
				$json = array("status" => 0, "msg" => "Something Went Wrong. Item Not found"); // Data Entry Not Successfull
			}

	}
	else
	{
		$json = array("status" => 0, "msg" => "Invalid Request Method "); // Data Entry Not Successfull
	}
}
else
{
	$json = array("status" => 0, "msg" => "Please Login To Access "); // Data Entry Not Successfull
}	
mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>