<?php
include_once 'connection.php' ;
error_reporting(E_ALL);
$method = $_SERVER['REQUEST_METHOD']; 

if($method == "POST")
{
		// if keyword is  set
		if(isset($_POST['searchKey']) && !empty($_POST['searchKey']))
		{
			$filter= " title like '%".$_POST['searchKey']."%' or description like '%".$_POST['searchKey']."%' ";
		}
		else
		{
			$filter="";
		}
		
		$category=$_POST['category'];
		$_SESSION['search_category']=$category;
		
		if(isset($_POST['company']) && !empty($_POST['company']))
		{
			$company=$_POST['company'];	
			$_SESSION['search_company']=$company;
		}
		else
		{
			$company=array("All");	
			$_SESSION['search_company']="All";
		}
		
		// get lattitude and longitude of location 
		if(isset($_POST['location']) && !empty($_POST['location']))
		{
			$location_array=explode(",",$_POST['location']);
			$count_element=count($location_array) ;
			
			$location=$_POST['location'];	
			$_SESSION['search_location']=$location;
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
			   $lat=isset($_COOKIE["UserLatitude"]) ?  $_COOKIE["UserLatitude"] : "37.386052";
			   $lng=isset($_COOKIE["UserLongitude"]) ? $_COOKIE["UserLongitude"] : "-122.083851";
			}

		}
		else
		{
			$location="All";
			$_SESSION['search_location']="";
			$count_element=0;
		}
		
		
		
		$radius_explode=explode("-",$_POST['radius']);
		$radius=$radius_explode[1];
		
		$_SESSION['search_filter_min'] =$radius_explode[0];
		$_SESSION['search_filter_max'] =$radius_explode[1];
		
		
		
		if($location=="All")
		{
			$location_filter="";
		}
		else
		{
			if($count_element>1)
			{
				$location_filter="( 3959 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance FROM products  HAVING distance < '$radius'" ;
			}
			else
			{
				$location_filter="( city='".$_POST['location']."' or state='".$_POST['location']."' or country='".$_POST['location']."' )" ;
			}
		}
		
		if($category=="All")
		{
			$category_filter="";
		}
		else
		{
			if($location_filter!="")
			{
				$category_filter=" and category='$category'";
			}
			else
			{
				$category_filter=" category='$category'";
			}
		}
		
		$total_companies= count($company);
		
		if(in_array("All",$company))
		{
			$company_filter="";
		}
		else
		{
			for($i=0;$i<$total_companies;$i++)
			{
				$cmp[]="company_name='".$company[$i]."'";
				if($i<$total_companies-1)
				{
					$cmp[].=" or ";
					continue;
				}
			}
			$company_name= implode(" ", $cmp);
			if($category_filter!="")
			{
				$company_filter="and ($company_name )";
			}
			else
			{
				if($location_filter!="")
				{
					$company_filter="and ($company_name )";
				}
				else
				{
					$company_filter="($company_name )";
				}
			}
		}
		
		if($company_filter!="")
		{
			if($filter!="")
			{
				$nameFilter= " and ($filter) ";
			}
			else
			{
				$nameFilter="";
			}
		}
		else
		{
			if($category_filter!="")
			{
				if($filter!="")
				{
					$nameFilter= " and ($filter) ";
				}
				else
				{
					$nameFilter="";
				}
			}
			else
			{
				if($location_filter!="")
				{
					if($filter!="")
					{
						$nameFilter= " and ($filter) ";
					}
					else
					{
						$nameFilter="";
					}
				}
				else
				{
					$nameFilter=$filter;
				}
			}
		}
		
		if($count_element>1)
		{
			//echo $sql= "SELECT * , $location_filter  $category_filter $company_filter  $nameFilter " ;
			$sql_query = mysqli_query($conn,"SELECT * , $location_filter  $category_filter $company_filter $nameFilter and approval_status='Approved' ") or die(mysqli_error($conn)."Error");
		}
		else
		{
			if($location_filter=="" && $category_filter=="" && $company_filter=="" && $nameFilter=="")
			{
				//echo $sql="SELECT * from products ";
				$sql_query = mysqli_query($conn,"SELECT * from products where approval_status='Approved'")or die(mysqli_error($conn)."Error1");
			}
			else
			{
				//echo $sql="SELECT * from products where  $location_filter  $category_filter $company_filter $nameFilter ";
				$sql_query = mysqli_query($conn,"SELECT * from products where  $location_filter  $category_filter $company_filter $nameFilter and approval_status='Approved' ")or die(mysqli_error($conn)."Error1");
			}
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
			$json = array("status" => 0, "msg" => " Sorry! No result found ","rows"=>$result_rows,"location"=>$location,"category"=>$category);
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
			if($result_rows==1){ $result_found="result found "; } else{ $result_found="results were found "; }
			
			$json = array("status" => 1, "msg" => " $result_rows $result_found  ","location"=>$location,"category"=>$category,"rows"=>$result_rows,$product_arraylist); 
		}
	}	 
}
else
{
	$json = array("status" => 0, "msg" => "Invalid Response","location"=>"","category"=>""); // If Response Method is not Post
}

$file = fopen("search_result.json", "w") or die("Unable to open file!");
$txt = json_encode($json);
chmod("search_result.json",0777);
fwrite($file, $txt);
fclose($file); 
/*
echo "<pre>";
print_r($json);
echo "</pre>";
die;*/

echo json_encode($json);
// setting Prity Url
if(isset($_POST['search']))
{
	
	$filter=$_POST['searchKey'];
	if($filter!="" && $filter!=" ")
	{
		header('Location:../Search/'.$filter);
	}
	else
	{
		header('Location:../Search/All');
	}
}
else
{
	$company_new = implode("+",$company);
	$filter=$_POST['searchKey'];
	if($filter!="" && $filter!=" ")
	{
		$url=str_replace(" ","",$filter."/".$category."/".$company_new."/".$_POST['location']."/".$_POST['radius']);
	}
	else
	{
		$url=str_replace(" ","",$category."/".$company_new."/".$_POST['location']."/".$_POST['radius']);
	}
	header('Location:../Search/'.$url);
}

?>

