<?php
ob_start();
session_start(); // start session again
include_once '../backpages/connection.php';
$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST")
{
	if(isset($_SESSION['session_admin_web']['valid']))
	{
		// Validate data
		function test_input($data) 
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	
		$catname=test_input($_POST['catname']);
		$description=test_input($_POST['description']);
		$description=mysqli_real_escape_string($conn,$_POST['description']);
		
		$cat_folder=str_replace(" ","_",$catname);
			
		$filename= $_FILES['upload_img']['name'];
		$_FILES['upload_img']['size'];
		$_FILES['upload_img']['error'];

		$a=4930;
		$s=$_FILES['upload_img']['size']/1024;

		if($s>$a)
		{
			$json = array("status" => 0, "msg" => "Sorry! The uploaded file exceeds the MAX_FILE_SIZE."); // If Not Login
		}
		else
		{
			if($_FILES['upload_img']['error']==1 ||$_FILES['upload_img']['error']==2||$_FILES['upload_img']['error']==3||$_FILES['upload_img']['error']==5||$_FILES['upload_img']['error']==6||$_FILES['upload_img']['error']==7)
			{
				$json = array("status" => 0, "msg" => "Sorry! Error in uploading file."); // If Not Login
			}
			if($_FILES['upload_img']['error']==4)
			{
				$json = array("status" => 0, "msg" => "Sorry! No Image Selected"); // If Not Login
			}
			else
			{
				$ext=pathinfo($filename,PATHINFO_EXTENSION);
				$filename = str_replace(" ","_",$catname).'.'.$ext;
										
				//create category folder where default image will be uploaded
				if (!file_exists("../upload/Categories/".$cat_folder)) 
				{
					mkdir("../upload/Categories/".$cat_folder,0777);
				}
				//create thumb folder for category Images 
				if (!file_exists("../upload/Categories/".$cat_folder."/thumb")) 
				{
					mkdir("../upload/Categories/".$cat_folder."/thumb",0777);
				}
				$target="../upload/Categories/".$cat_folder."/".$filename;
				$target1="upload/Categories/".$cat_folder."/".$filename;
				$target2="../upload/Categories/".$cat_folder."/thumb/".$filename;
				
				$info=pathinfo($filename,PATHINFO_EXTENSION);
				$a=array("JPG","GIF","PNG","JPEG","BMP","RIF","rif","jpg","gif","png","jpeg","bmp");
				if(in_array($info,$a))
				{
					move_uploaded_file($_FILES['upload_img']['tmp_name'],$target);
					$imagePath=$url_root.$target1; 
					copy($target,$target2);
					$query = mysqli_query($conn,"insert into categories(category_name,category_description,category_picture)
				    values('$catname','$description','$imagePath')") or die(mysqli_error($conn)."Error");
					if($query)
					{
						$json = array("status" => 1, "msg" => "Category Addedd");
					}
					else
					{
						$json = array("status" => 0, "msg" => "Something Went Wrong"); 
					}
				}
				else
				{
					$json = array("status" => 0, "msg" => "File type not supported"); // If file format not supported
				}
			}
		}

		
		
	}
	else
	{
		$json = array("status" => 0, "msg" => "unauthorized Access! Please Login"); // If Not Login
	}
}
else
{
	$json = array("status" => 0, "msg" => "Request method not accepted"); // If Request method is not Post
}
mysqli_close($conn);// Close Connection
//header('Content-type: application/json'); // Output header 
if($json['status']=="1")
{
	header('location:categories.php');
}
else
{
	echo json_encode($json);
	echo "<a href='login.php'><button type='button'> Login Now </button></a>";
	die;
}

?>