<?php
//start session
session_start();

if(isset($_SESSION["loggedin_user_id"]) && !empty($_SESSION["user"])) 
{
	$user = $_SESSION["user"];
	$oauth_uid=$user->id;
	$_SESSION['login_status']=true;
	$_SESSION['linkedin_uid']=$oauth_uid; //oauth_uid
	$_SESSION['login_via']="linkedin";
	header('Location:../index.php');
}
else
{	
	if(isset($_SESSION["err_msg"]) && $_SESSION["err_msg"] <> "")
	{
		$_SESSION['login_status']=false;
		$_SESSION['login_error']=$_SESSION["err_msg"];
	}
	header('Location:process.php');
}
?>