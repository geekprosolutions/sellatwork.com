<?php 
if(isset($_SERVER['HTTP_REFERER']))
{
	$ref = $_SERVER['HTTP_REFERER'];
	$ref = preg_replace("/http:\/\//i", "", $ref);
	$ref = preg_replace("/^www\./i", "", $ref );
	$ref = preg_replace("/\/.*/i", "", $ref );
	$domain = $_SERVER['HTTP_HOST']; 
	$referer = $ref ;
	if ($referer == $domain) 
	{
		$_SESSION['session_web']['last_url']=$_SERVER['HTTP_REFERER'] ;
	}
	else
	{
		$_SESSION['session_web']['last_url']="index.php";
	}
}
?>