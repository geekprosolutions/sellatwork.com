<?php
class DB 
{
	function __construct(){
		$this->dbConnect();
		$this->userTable = 'users';
	}
	
	function dbConnect(){
		// database configuration
		$dbServer = 'localhost'; //Define database server host
		$dbUsername = 'geekpro'; //Define database username
		$dbPassword = 'geekpro1'; //Define database password
		$dbName = 'sellatwork'; //Define database name
		
		
		$conn = new mysqli($dbServer,$dbUsername,$dbPassword,$dbName);
		if($conn){
			$this->db = $conn;
		}else{
			die("Database conection error: ".$conn->connect_error);
		}
	}
	
	function checkUser($userdata)
	{
		$oauth_uid = $userdata->id;
		$email = $userdata->emailAddress;
		$linkedin_url= $userdata->publicProfileUrl;
		$username=$userdata->firstName." ".$userdata->lastName;
		$userphoto=$userdata->pictureUrl;
		
		$last_login_on=date("d-m-Y h:i:s a");
		$joining_date=date("d-m-Y");
		$login_status=1 ;
		
		$company=explode("@",$email);
		$company=explode(".",$company[1]);
		$companyName=$company[0];
		
		
		$city=isset($_COOKIE["UserCity"]) ? $_COOKIE["UserCity"] : "Not Available" ;
		$state=isset($_COOKIE["UserState"]) ? $_COOKIE["UserState"] : "Not Available";
		$country=isset($_COOKIE["UserCountry"]) ? $_COOKIE["UserCountry"] : "Not Available";
		$lat=isset($_COOKIE["UserLatitude"]) ?$_COOKIE["UserLatitude"] : "";
		$lng=isset($_COOKIE["UserLongitude"]) ? $_COOKIE["UserLongitude"] : "";
		$location=isset($_COOKIE["UserLocation"]) ? $_COOKIE["UserLocation"] : "Not Available";
		
		$check = $this->db->query("SELECT * FROM $this->userTable WHERE oauth_uid = '".$oauth_uid."' AND email = '".$email."'");
		if(mysqli_num_rows($check) > 0){
			$result = $check->fetch_array(MYSQLI_ASSOC);
			$query = "UPDATE $this->userTable SET username = '$username', email = '$email',last_login_on='$last_login_on' ,login_status=$login_status WHERE user_id = ".$result['user_id'];
			$this->db->query($query);
			return $result['user_id'];
		}
		else
		{
			$query = "INSERT INTO $this->userTable(oauth_provider,oauth_uid,username,email,city,state,country,location,lattitude,longitude,userphoto,company_name,account_verified,last_login_on,login_status,join_on,loginvia) 
					  VALUES('Linkedin','$oauth_uid','$username','$email','$city','$state','$country','$location','$lat','$lng','$userphoto','$companyName','Verified','$last_login_on',$login_status,'$joining_date','Linkedin')";
			$this->db->query($query);
			return $this->db->insert_id;
		}
	}
}
?>