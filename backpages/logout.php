<?php
include "connection.php";
// Logout If Person is inactive For Defined Time Period
if (isset($_SESSION['session_web']['valid']) && $_SESSION['session_web']['valid'] == true) 
{
	$login_status=0; // Change User Status Form Login To Logout
	$sql_query=mysqli_query($conn,"update users set login_status=$login_status where user_id='".$_SESSION['session_web']['login_userId']."'");
	session_destroy();
	header('Location:'.$url_root.'login.php');
}
else
{
	session_destroy();
	header('Location:'.$url_root.'login.php');
}
?>