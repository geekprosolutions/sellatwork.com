<?php
ob_start();
session_start();
// Include connection.php
include_once '../backpages/connection.php';

$loginby=$_SESSION['login_via'];

if($loginby=="linkedin")
{
	if(isset($_SESSION['login_status']) && $_SESSION['login_status']==true)
	{
		$authid=$_SESSION['linkedin_uid'];
		$query=mysqli_query($conn,"select * from users where oauth_uid='$authid' ") or die(mysqli_error($conn)."Error");
		$fetch=mysqli_fetch_array($query);
		session_destroy();
		session_start();
		$_SESSION['session_web']['valid']=true;
		$_SESSION['session_web']['login_userName']=$fetch['username'];
		$_SESSION['session_web']['login_userStatus']="Online";
		$_SESSION['session_web']['login_userId']=$fetch['user_id'];
		$_SESSION['session_web']['login_userEmail']=$fetch['email'];
		$_SESSION['session_web']['login_userPhoto']=$fetch['userphoto'];
		$_SESSION['session_web']['login_userVerified']=$fetch['account_verified'];
		$_SESSION['session_web']['login_userCompanyVerified']=$fetch['company_verified'];
		header('Location:../index.php');

		$_SESSION['session_web']['login_Counter']=$fetch['login_counter'];
		$_SESSION['session_web']['index_page_visit']=0;
		$new_login_counter=$fetch['login_counter']+1;
		
		$sql_query2=mysqli_query($conn,"update users set login_counter=$new_login_counter where oauth_uid='$authid' ");
		
	}
	else
	{
		$json = array("status" => 0, "msg" => $_SESSION['login_error']);
		echo json_encode($json);
		echo "<a href='../login.php'><button type='button' > Login Again </button></a>";
		die;
	}
}
else
{
	$authid=$_SESSION['authid'];
	$query=mysqli_query($conn,"select * from users where oauth_uid='$authid' ") or die(mysqli_error($conn)."Error");
	$fetch=mysqli_fetch_array($query);
	session_destroy();
	session_start();
	$_SESSION['session_web']['valid']=true;
	$_SESSION['session_web']['login_userName']=$fetch['username'];
	$_SESSION['session_web']['login_userStatus']="Online";
	$_SESSION['session_web']['login_userId']=$fetch['user_id'];
	$_SESSION['session_web']['login_userEmail']=$fetch['email'];
	$_SESSION['session_web']['login_userPhoto']=$fetch['userphoto'];
	$_SESSION['session_web']['login_userVerified']=$fetch['account_verified'];
	$_SESSION['session_web']['login_userCompanyVerified']=$fetch['company_verified'];
		
	header('Location:../index.php');
	
	$_SESSION['session_web']['login_Counter']=$fetch['login_counter'];
	$_SESSION['session_web']['index_page_visit']=0;
	$new_login_counter=$fetch['login_counter']+1;
	
	$sql_query2=mysqli_query($conn,"update users set login_counter=$new_login_counter where oauth_uid='$authid' ");
	
}
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/
?>