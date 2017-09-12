<?php
// Get Products Details //

//Products Divison in Four Category 
// => Recent Adds
// => My Office
// => Arround Me 

$allAdds=array();
$recentAdds=array();
$myOffice=array();
$aroundMe=array();

$lat=isset($_COOKIE["UserLatitude"]) ?$_COOKIE["UserLatitude"] : "37.386052";
$lng=isset($_COOKIE["UserLongitude"]) ? $_COOKIE["UserLongitude"] : "-122.083851";

if($lat!="" || $lng!="")
{
	$sql_query1 = mysqli_query($conn,"SELECT * , ( 3959 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance FROM products  HAVING distance < '50'  and approval_status='Approved' order by product_id desc ");
}
else
{
	$sql_query1=mysqli_query($conn,"select * from products where approval_status='Approved' order by product_id desc");
}
$total_rows=mysqli_num_rows($sql_query1);
if($total_rows==0)
{
	$allAdds=$recentAdds=$myOffice=$aroundMe=array("status"=>0,"msg"=>" Sorry! No Record Found In Database");
}
else
{
	// All Products Array 
	while($result=mysqli_fetch_array($sql_query1))
	{
		$allProducts['product_id']=$result['product_id'];
		$allProducts['user_id']=$result['user_id'];
		$sql_query2=mysqli_query($conn,"select * from users where user_id='".$result['user_id']."' ");
		$fetch=mysqli_fetch_array($sql_query2);
		$allProducts['username']=$fetch['username'];
		$allProducts['userphoto']=$fetch['userphoto'];
		$allProducts['email']=$fetch['email'];
		$allProducts['company_name']=$fetch['company_name'];
		$allProducts['title']=$result['title'];
		$allProducts['category']=$result['category'];
		$allProducts['price']=$result['price'];
		$allProducts['description']=$result['description'];
		$allProducts['location']=$result['location'];
		$allProducts['pro_image']=$result['pro_image'];
		$allProducts['upload_on']=$result['upload_on'];
		
		$array[]=$allProducts;
	}
	$allAdds=array("status" => 1, "msg" => " $total_rows  Results Were Found. ",$array);
	
	// My Office Adds
	if(isset($_SESSION['session_web']['valid']))
	{
		// Get Company Name Of User
		$sql_query3=mysqli_query($conn,"select * from users where user_id='".$_SESSION['session_web']['login_userId']."' ");
		$result2=mysqli_fetch_array($sql_query3);
		$company_name=$result2['company_name'];
		
		// Get Adds from My Office
		
		
		if($lat!="" || $lng!="")
		{
			$sql_query4 = mysqli_query($conn,"SELECT * , ( 3959 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance FROM products  HAVING distance < '50' and company_name='$company_name' and approval_status='Approved'  order by product_id desc");
		}
		else
		{
			$sql_query4=mysqli_query($conn,"select * from products where company_name='$company_name' and approval_status='Approved' order by product_id desc");
		}
		
		
		$total_rows4=mysqli_num_rows($sql_query4);
		if($total_rows4==0)
		{
			$myOffice=array("status"=>0,"msg"=>" Sorry! No Record Found In Database","company_name"=>$company_name);
		}
		else
		{
			// All Products Array 
			while($result4=mysqli_fetch_array($sql_query4))
			{
				$myOffice['product_id']=$result4['product_id'];
				$myOffice['user_id']=$result4['user_id'];
				$sql_query5=mysqli_query($conn,"select * from users where user_id='".$result4['user_id']."' ");
				$fetch5=mysqli_fetch_array($sql_query5);
				$myOffice['username']=$fetch5['username'];
				$myOffice['userphoto']=$fetch5['userphoto'];
				$myOffice['email']=$fetch5['email'];
				$myOffice['company_name']=$fetch5['company_name'];
				$myOffice['title']=$result4['title'];
				$myOffice['category']=$result4['category'];
				$myOffice['price']=$result4['price'];
				$myOffice['description']=$result4['description'];
				$myOffice['location']=$result4['location'];
				$myOffice['pro_image']=$result4['pro_image'];
				$myOffice['upload_on']=$result4['upload_on'];
				
				$array1[]=$myOffice;
			}
			$myOffice= array("status" => 1, "msg" => "<b>$total_rows4 </b> Results Were Found. ","company_name"=>$company_name,$array1);
		}	
	}
	else
	{
		$myOffice=array("status"=>0,"msg"=>" Sorry! You Have To login First ");
	}
		
	
	
	
		if(isset($_SESSION['userlocation']['lat']) && isset($_SESSION['userlocation']['lng']))
		{
			
			$lat=$_SESSION['userlocation']['lat'];
			$lng=$_SESSION['userlocation']['lng'];
			
			// Get Adds from My Office
			$sql_query4 = mysqli_query($conn,"SELECT * , ( 3959 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance FROM products  HAVING distance < '50' and approval_status='Approved' order by product_id desc");
			
			
			$total_rows4=mysqli_num_rows($sql_query4);
			if($total_rows4==0)
			{
				$aroundMe=array("status"=>0,"msg"=>" Sorry! No Record Found In Database");
			}
			else
			{
				// All Products Array 
				while($result4=mysqli_fetch_array($sql_query4))
				{
					$around['product_id']=$result4['product_id'];
					$around['user_id']=$result4['user_id'];
					$sql_query5=mysqli_query($conn,"select * from users where user_id='".$result4['user_id']."' ");
					$fetch5=mysqli_fetch_array($sql_query5);
					$around['username']=$fetch5['username'];
					$around['userphoto']=$fetch5['userphoto'];
					$around['email']=$fetch5['email'];
					$around['company_name']=$fetch5['company_name'];
					$around['title']=$result4['title'];
					$around['category']=$result4['category'];
					$around['price']=$result4['price'];
					$around['description']=$result4['description'];
					$around['location']=$result4['location'];
					$around['pro_image']=$result4['pro_image'];
					$around['upload_on']=$result4['upload_on'];
					
					$array3[]=$around;
				}
				$aroundMe= array("status" => 1, "msg" => "<b>$total_rows4 </b> Results Were Found. ",$array3);
			}	
		}
		elseif(!isset($_SESSION['userlocation']['lat']) || !isset($_SESSION['userlocation']['lng']) || $_SESSION['userlocation']['lat']=="" || $_SESSION['userlocation']['lng']=="")
		{
			
			// Get Adds that Are Around Me
			if(isset($_SESSION['session_web']['valid']))
			{
				
				// Get User Location From Database Of User
				$sql_query3=mysqli_query($conn,"select * from users where user_id='".$_SESSION['session_web']['login_userId']."'  ");
				$result2=mysqli_fetch_array($sql_query3);
				$lat=$result2['lattitude'];
				$lng=$result2['longitude'];
				
				// Get Adds from My Office
				$sql_query4 = mysqli_query($conn,"SELECT * , ( 3959 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance FROM products  HAVING distance < '50' and approval_status='Approved'  ORDER by product_id desc");
				$total_rows4=mysqli_num_rows($sql_query4);
				if($total_rows4==0)
				{
					$aroundMe=array("status"=>0,"msg"=>" Sorry! No Record Found In Database");
				}
				else
				{
					// All Products Array 
					while($result4=mysqli_fetch_array($sql_query4))
					{
						$around['product_id']=$result4['product_id'];
						$around['user_id']=$result4['user_id'];
						$sql_query5=mysqli_query($conn,"select * from users where user_id='".$result4['user_id']."' ");
						$fetch5=mysqli_fetch_array($sql_query5);
						$around['username']=$fetch5['username'];
						$around['userphoto']=$fetch5['userphoto'];
						$around['email']=$fetch5['email'];
						$around['company_name']=$fetch5['company_name'];
						$around['title']=$result4['title'];
						$around['category']=$result4['category'];
						$around['price']=$result4['price'];
						$around['description']=$result4['description'];
						$around['location']=$result4['location'];
						$around['pro_image']=$result4['pro_image'];
						$around['upload_on']=$result4['upload_on'];
						
						$array3[]=$around;
					}
					$aroundMe= array("status" => 1, "msg" => "<b>$total_rows4 </b> Results Were Found. ",$array3);
				}	
			}
			else
			{
				if($lat!="" && $lng!="")
				{

					// Get Adds from My Office
					$sql_query4 = mysqli_query($conn,"SELECT * , ( 3959 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance FROM products  HAVING distance < '50' and approval_status='Approved' ORDER by product_id desc");
					$total_rows4=mysqli_num_rows($sql_query4);
					if($total_rows4==0)
					{
						$aroundMe=array("status"=>0,"msg"=>" Sorry! No Record Found In Database");
					}
					else
					{
						// All Products Array 
						while($result4=mysqli_fetch_array($sql_query4))
						{
							$around['product_id']=$result4['product_id'];
							$around['user_id']=$result4['user_id'];
							$sql_query5=mysqli_query($conn,"select * from users where user_id='".$result4['user_id']."' ");
							$fetch5=mysqli_fetch_array($sql_query5);
							$around['username']=$fetch5['username'];
							$around['userphoto']=$fetch5['userphoto'];
							$around['email']=$fetch5['email'];
							$around['company_name']=$fetch5['company_name'];
							$around['title']=$result4['title'];
							$around['category']=$result4['category'];
							$around['price']=$result4['price'];
							$around['description']=$result4['description'];
							$around['location']=$result4['location'];
							$around['pro_image']=$result4['pro_image'];
							$around['upload_on']=$result4['upload_on'];
							
							$array3[]=$around;
						}
						$aroundMe= array("status" => 1, "msg" => "<b>$total_rows4 </b> Results Were Found. ",$array3);
					}	
				}
				else
				{
					$aroundMe=array("status"=>0,"msg"=>" Sorry! No Record Found In Database");
				}
					
			}
		}
	
}
?>