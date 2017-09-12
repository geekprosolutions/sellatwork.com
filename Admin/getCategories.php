<?php
ob_start();
session_start();
include "../backpages/connection.php";
$sql=mysqli_query($conn,"select * from categories") or die(mysqli_error($conn)."error");

while($fetch=mysqli_fetch_array($sql))
{
	$name['category_name']=$fetch['category_name'];
	$name['category_description']=$fetch['category_description'];
	$name['category_picture']=$fetch['category_picture'];
	$json[]=$name;
}

mysqli_close($conn);// Close Connection
header('Content-type: application/json'); // Output header 
echo json_encode($json);

/*echo "<pre>";
print_r($json);
echo "</pre>"; */
?>