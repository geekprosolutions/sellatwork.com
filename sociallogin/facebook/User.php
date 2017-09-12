<?php
class User {
	private $dbHost     = "localhost";
    private $dbUsername = "geekpro";
    private $dbPassword = "geekpro1";
    private $dbName     = "sellatwork";
	private $userTbl    = 'users';
	
	function __construct(){
		if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
	}
	
	function checkUser($userData = array())
	{
		if(!empty($userData))
		{
			$conn=mysqli_connect("localhost","geekpro","geekpro1");
			$db=mysqli_select_db($conn,"sellatwork");
			
			date_default_timezone_set("Asia/Calcutta");
			$username=$userData['first_name']." ".$userData['last_name'];
			$userphoto=$userData['picture'];
			$last_login_on=date("d-m-Y h:i:s a");
			$joining_date=date("d-m-Y");
			$login_status=1 ;
			
			$company=explode("@",$userData['email']);
			$company=explode(".",$company[1]);
			$companyName=$company[0];		
						
			$city=isset($_COOKIE["UserCity"]) ? $_COOKIE["UserCity"] : "Not Available" ;
			$state=isset($_COOKIE["UserState"]) ? $_COOKIE["UserState"] : "Not Available";
			$country=isset($_COOKIE["UserCountry"]) ? $_COOKIE["UserCountry"] : "Not Available";
			$lat=isset($_COOKIE["UserLatitude"]) ?$_COOKIE["UserLatitude"] : "";
			$lng=isset($_COOKIE["UserLongitude"]) ? $_COOKIE["UserLongitude"] : "";
			$location=isset($_COOKIE["UserLocation"]) ? $_COOKIE["UserLocation"] : "Not Available";
			
			
			// Check whether user data already exists in database
			
			$prevQuery = "SELECT * FROM ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
			$prevResult = $this->db->query($prevQuery);
			if($prevResult->num_rows > 0){
				// Update user data if already exists
				$update=mysqli_query($conn,"UPDATE users SET username='$username', email = '".$userData['email']."',fb_link = '".$userData['link']."',last_login_on='$last_login_on',login_status=$login_status WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'");
				
			}else{
				// Insert user data
				
				$insert=mysqli_query($conn,"insert into users (username,email,city,state,country,location,lattitude,longitude,userphoto,company_name,account_verified,oauth_provider,oauth_uid ,fb_link,loginvia,join_on,last_login_on,login_status) values('$username','".$userData['email']."','$city','$state','$country','$location','$lat','$lng','".$userData['picture']."','$companyName','Verified','".$userData['oauth_provider']."','".$userData['oauth_uid']."','".$userData['link']."','Facebook','$last_login_on','$last_login_on',$login_status) ") ;
				
			}
			
			// Get user data from the database
			$result = $this->db->query($prevQuery);
			$userData = $result->fetch_assoc();
		}
		
		// Return user data
		return $userData;
	}
}
?>