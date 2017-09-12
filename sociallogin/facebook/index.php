<?php
@session_start();
error_reporting(E_ALL);
// Include FB config file && User class
require_once 'fbConfig.php';
require_once 'User.php';

if(isset($accessToken)){
	if(isset($_SESSION['facebook_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}else{
		// Put short-lived access token in session
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
	  	// OAuth 2.0 client handler helps to manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();
		
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		
		// Set default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	
	// Redirect the user back to the same page if url has "code" parameter in query string
	if(isset($_GET['code'])){
		header('Location: ./');
	}
	
	// Getting user facebook profile info
	try {
		$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
		$fbUserProfile = $profileRequest->getGraphNode()->asArray();		
	} catch(FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// Redirect user back to app login page
		header("Location: ./");
		exit;
	} catch(FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	// Initialize User class
	$user = new User();
	
	// Insert or update user data to the database
	$fbUserData = array(
		'oauth_provider'=> 'facebook',
		'oauth_uid' 	=> $fbUserProfile['id'],
		'first_name' 	=> $fbUserProfile['first_name'],
		'last_name' 	=> $fbUserProfile['last_name'],
		'email' 		=> $fbUserProfile['email'],
		'gender' 		=> $fbUserProfile['gender'],
		'locale' 		=> $fbUserProfile['locale'],
		'picture' 		=> $fbUserProfile['picture']['url'],
		'link' 			=> $fbUserProfile['link']
	);
	$userData = $user->checkUser($fbUserData);
	
	// Put user data into session
	$_SESSION['userData'] = $userData;
	if(!empty($userData))
	{
		
		$conn=mysqli_connect("localhost","geekpro","geekpro1");
		$db=mysqli_select_db($conn,"sellatwork");
		$authid=$userData['oauth_uid'];
		$query=mysqli_query($conn,"select * from users where oauth_uid='$authid' ") or die(mysqli_error($conn)."Error");
		$fetch=mysqli_fetch_array($query);
		
		$_SESSION['session_web']['valid']=true;
		$_SESSION['session_web']['login_userName']=$userData['username'];
		$_SESSION['session_web']['login_userStatus']="Online";
		$_SESSION['session_web']['login_userId']=$userData['user_id'];
		$_SESSION['session_web']['login_userEmail']=$userData['email'];
		$_SESSION['session_web']['login_userPhoto']=$userData['userphoto'];
		$_SESSION['session_web']['login_userVerified']=$fetch['account_verified'];
		$_SESSION['session_web']['login_userCompanyVerified']=$fetch['company_verified'];		
		$_SESSION['session_web']['login_Counter']=$fetch['login_counter'];
		$_SESSION['session_web']['index_page_visit']=0;
		$new_login_counter=$fetch['login_counter']+1;
		$sql_query2=mysqli_query($conn,"update users set login_counter=$new_login_counter where oauth_uid='$authid' ");
		header("Location: https://www.sellatwork.com/");
	}
	// Get logout url
	//$logoutURL = $helper->getLogoutUrl($accessToken, $redirectURL.'logout.php');

}
else
{
	// Get login url
	$loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
	header('Location:'.$loginURL);
}
?>
