<?php
ob_start();
session_start();
include "../backpages/connection.php";
// Logout If Person is inactive For Defined Time Period
if (isset($_SESSION['session_admin_web']['valid']) && $_SESSION['session_admin_web']['valid'] == true) 
{
	$login_status=0; // Change User Status Form Login To Logout
	$sql_query=mysqli_query($conn,"update admin set login_status=$login_status ");
	session_destroy();
	header('Location:login.php');
}

?>