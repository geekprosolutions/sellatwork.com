<?php
if(isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid']==true)
{
	// Get User Details //
	$sql_query1=mysqli_query($conn,"select * from users where user_id='".$_SESSION['session_web']['login_userId']."' ");
	if(!$sql_query1)
	{
		header('Refresh:1;url='.$url_root.'index.php');
		echo "Error in Executing Query. Redirecting Please Wait...";
		die;
	}
	else
	{
		$result=mysqli_fetch_assoc($sql_query1);
		$userinfo['user_id']=$result['user_id'];
		$userinfo['username']=$result['username'];
		$userinfo['email']=$result['email'];
		$userinfo['password']=$result['password'];
		//city
		if($result['city']=="Not Available" )
		{
			$userinfo['city']=isset($_COOKIE["UserCity"]) ? $_COOKIE["UserCity"] : "Mountain View" ;
		}
		else
		{
			$userinfo['city']=$result['city'];
		}
		//country
		if($result['country']=="Not Available")
		{
			$userinfo['country']=isset($_COOKIE["UserCountry"]) ? $_COOKIE["UserCountry"] : "United States";
		}
		else
		{
			$userinfo['country']=$result['country'];
		}
		//state
		if($result['state']=="Not Available")
		{
			$userinfo['state']=isset($_COOKIE["UserState"]) ? $_COOKIE["UserState"] : "California";
		}
		else
		{
			$userinfo['state']=$result['state'];
		}
		// location
		if($result['location']=="Not Available")
		{
			$userinfo['location']=isset($_COOKIE["UserLocation"]) ? $_COOKIE["UserLocation"] : "Mountain View, California, United States";
		}
		else
		{
			$userinfo['location']=$result['location'];
		}
		
		// latitude
		if($result['lattitude']=="0" || $result['lattitude']=="")
		{
			$userinfo['lattitude']=isset($_COOKIE["UserLatitude"]) ? $_COOKIE["UserLatitude"] : "37.386052";
		}
		else
		{
			$userinfo['lattitude']=$result['lattitude'];
		}
		// longitude
		if($result['longitude']=="0" || $result['longitude']=="" )
		{
			$userinfo['longitude']=isset($_COOKIE["UserLongitude"]) ? $_COOKIE["UserLongitude"] : "-122.083851";
		}
		else
		{
			$userinfo['longitude']=$result['longitude'];
		}
		
		$userinfo['userphoto']=$result['userphoto'];
		$userinfo['loginvia']=$result['loginvia'];
		$userinfo['company_name']=$result['company_name'];
		$json = array("status" => 1, "msg" => "User Information",$userinfo); // If connection fail
		//echo json_encode($json);
	}
}
else
{
	header('Refresh:1;url='.$url_root.'login.php');
	echo "Unauthorized Access!! Please Login To Begin" ; 
	die;
}
?>