<?php
class Users {
	public $tableName ="users";
	
	function __construct(){
		
		// database configuration
		$dbServer = 'localhost'; //Define database server host
		$dbUsername = 'geekpro'; //Define database username
		$dbPassword = 'geekpro1'; //Define database password
		$dbName = 'sellatwork'; //Define database name
		
		
		//connect databse
		$con = mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
		if(mysqli_connect_errno()){
			die("Failed to connect with MySQL: ".mysqli_connect_error());
		}else{
			$this->connect = $con;
		}
	}
	
	function checkUser($oauth_provider,$oauth_uid,$fname,$lname,$email,$gender,$locale,$link,$picture)
	{
		$username=$fname." ".$lname;
		$userphoto=$picture;
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
		
		
		$prevQuery = mysqli_query($this->connect,"SELECT * FROM $this->tableName WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'") or die(mysqli_error($this->connect));
		if(mysqli_num_rows($prevQuery) > 0){
			$update = mysqli_query($this->connect,"UPDATE $this->tableName SET oauth_provider = '".$oauth_provider."', oauth_uid = '".$oauth_uid."',username='$username', email = '".$email."',gpluslink = '".$link."',last_login_on='$last_login_on' ,login_status=$login_status WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'") ;
		}
		else
		{
			$insert = mysqli_query($this->connect,"INSERT INTO $this->tableName SET oauth_provider = '".$oauth_provider."', oauth_uid = '".$oauth_uid."', username='$username', email = '".$email."',city='$city',state='$state',country='$country',location='$location',lattitude='0',longitude='0',userphoto='$userphoto',company_name='$companyName',account_verified='Verified',gpluslink = '".$link."',last_login_on='$last_login_on',join_on='$joining_date',login_status=$login_status,loginvia='Google' ") ;
		}
		
		
		$query = mysqli_query($this->connect,"SELECT * FROM $this->tableName WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'") or die(mysqli_error($this->connect));
		$result = mysqli_fetch_array($query);
		return $result;
	}
}
?>