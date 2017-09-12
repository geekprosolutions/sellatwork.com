<?php
ob_start();
session_start(); // start session again
include_once '../backpages/connection.php';

$method = $_SERVER['REQUEST_METHOD'];
$_POST = json_decode(file_get_contents('php://input'), true);

if($method == "POST")
{
	$url=$_POST['new_url'];
	$url = filter_var($url, FILTER_SANITIZE_URL);
	
	// Validate url
	if (!filter_var($url, FILTER_VALIDATE_URL) === false) 
	{
		// Update User table
		$sql_query2=mysqli_query($conn,"update admin set url_root='$url' ");
		$json = array("status" => 1, "msg" => "Url Root Changes "); // If Login is Successfull
		
		$_SESSION['session_admin_web']['login_url_root']= $url;
	}
	else 
	{
		$json = array("status" => 0, "msg" => "Invalid Url"); // If Login Credential fails
	}

}
else
{
	$json = array("status" => 0, "msg" => "Request method not accepted"); // If Request method is not Post
}

mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);
?>