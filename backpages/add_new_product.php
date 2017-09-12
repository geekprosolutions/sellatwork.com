<?php
include "connection.php";
include "userinfo.php";
$_POST = json_decode(file_get_contents('php://input'), true);
$method = $_SERVER['REQUEST_METHOD']; 
if(isset($_SESSION['session_web']['valid']))
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
			
			if($lat!="" && $lng!="")
			{
				 function getAddress($lat, $lon)
				 {
					$url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lon."&sensor=false";
					$json = @file_get_contents($url);
					$data = json_decode($json);
					$status = $data->status;
					$address = '';
					if($status == "OK")
					{
					  $address = $data->results[2]->formatted_address;
					}
					return  $data;
				  }

				  $add=getAddress($lat,$lng);

				$geoResults = [];
				foreach($add->results as $result)
				{
					$geoResult = [];    
					foreach ($result->address_components as $address) {
						if ($address->types[0] == 'country') {
							$geoResult['country'] = $address->long_name;
						}
						if ($address->types[0] == 'administrative_area_level_1') {
							$geoResult['state'] = $address->long_name;
						}
						if ($address->types[0] == 'administrative_area_level_2') {
							$geoResult['county'] = $address->long_name;
						}
						if ($address->types[0] == 'locality') {
							$geoResult['city'] = $address->long_name;
						}
						if ($address->types[0] == 'postal_code') {
							$geoResult['postal_code'] = $address->long_name;
						}       
						if ($address->types[0] == 'route') {
							$geoResult['route'] = $address->long_name;
						}       
					}
					$geoResults[] = $geoResult;
					
				}

				$city=$geoResults[0]['city'];
				$state=$geoResults[0]['state'];
				$country=$geoResults[0]['country'];
			}
			else
			{
				$city=isset($_COOKIE["UserCity"]) ? $_COOKIE["UserCity"] : "Mountain View" ;
				$state=isset($_COOKIE["UserState"]) ? $_COOKIE["UserState"] : "California";
				$country=isset($_COOKIE["UserCountry"]) ? $_COOKIE["UserCountry"] : "United States";
			}
			
			$sql=mysqli_query($conn,"select * from categories where category_name='$category' ") or die(mysqli_error($conn)."ERROR1");
			$fetch=mysqli_fetch_array($sql);
			$imagepath=$fetch['category_picture'];		
			
			
			$sql_query_22=mysqli_query($conn,"select * from products where user_id=$userId and upload_on like '%$current_date%' ") or die(mysqli_error($conn)."error");
			$sql_query_22_rows=mysqli_num_rows($sql_query_22);
			if($sql_query_22_rows>=5)
			{
				$approval_status="Not Approved";
			}
			else
			{
				if($country!="United States" && $country!="U.S"  && $country!="US" && $country!="USA" )
				{
					$approval_status="Not Approved";
				}
				else
				{
					$approval_status="Approved";
				}
			}
			
			
			//Insert data into database 
			$sql_query1=mysqli_query($conn,"insert into products(user_id,company_name,title,category,price,description,location,city,state,country,lat,lng,pro_image,upload_on,approval_status) values($userId,'$company_name','$title','$category','$price','$description','$location','$city','$state','$country','$lat','$lng','$imagepath','$current_date_time','$approval_status')")or die(mysqli_error($conn)."ERROR 2");
			$last_id=mysqli_insert_id($conn);
			
			//Set Last Product Id 
			$_SESSION['session_web']['last_product_id']=$last_id;
			if($sql_query1)
			{
				$json = array("status" => 1, "msg" => "Product Added Successfully"); // Successfull Message
			}
			else
			{
				$json = array("status" => 0, "msg" => "Something Went Wrong"); // Data Entry Not Successfull
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