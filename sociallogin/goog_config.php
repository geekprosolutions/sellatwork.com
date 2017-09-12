<?php
@session_start();
include "../backpages/connection.php";
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '373083657071-f18q7oaikoqp6rjp7d2pm5n59ghsa9k3.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'IOAueVWeuUfEHkkinly2Q8vw'; //Google CLIENT SECRET
$redirectUrl = $url_root.'sociallogin/redirect.php?req=goog';  //return url (url to script)
$homeUrl =     $url_root.'sociallogin/redirect.php?req=goog';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login to sellatwork.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);
$gClient->setAccessType("online");
$gClient->setApprovalPrompt('auto') ;
$google_oauthV2 = new Google_Oauth2Service($gClient);
?>