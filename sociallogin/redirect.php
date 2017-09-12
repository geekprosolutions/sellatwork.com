<?php

$login_by=$_GET['req'];
if($login_by=="goog")
{
		session_start();
		include_once("goog_config.php");
		include_once("goog_includes/functions.php");
	
	
		if(isset($_REQUEST['code'])){
			$gClient->authenticate();
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectUrl, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) {
			$gClient->setAccessToken($_SESSION['token']);
		}

		if ($gClient->getAccessToken()) {
			$userProfile = $google_oauthV2->userinfo->get();
			//DB Insert
			$gUser = new Users();
			$gUser->checkUser('google',$userProfile['id'],$userProfile['given_name'],$userProfile['family_name'],$userProfile['email'],$userProfile['gender'],$userProfile['locale'],$userProfile['link'],$userProfile['picture']);
			$_SESSION['google_data'] = $userProfile; // Storing Google User Data in Session
			header("location: index.php");
			
			$_SESSION['authid']=$userProfile['id'];
			$_SESSION['login_via']="Google";
			$_SESSION['token'] = $gClient->getAccessToken();
			
		} 
		else 
		{
			$authUrl = $gClient->createAuthUrl();
		}

		if(isset($authUrl))
		{
			header("location: $authUrl");
		} 

}


?>