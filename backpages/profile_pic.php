<?php
@session_start();
/*********************************************************************
     Purpose            : update image.
     Parameters         : null
     Returns            : integer
     ***********************************************************************/
	 $post = isset($_POST) ? $_POST: array();
	 //print_R($post);die;
	 switch($post['action']) {
	  case 'save' :
		saveAvatarTmp();
	  break;
	  default:
		changeAvatar();
	}
	
	 function changeAvatar() {
        $post = isset($_POST) ? $_POST: array();
        $max_width = "500"; 
        $userId = isset($post['hdn-profile-id']) ? intval($post['hdn-profile-id']) : 0;
        $path = "../upload/".str_replace(" ","_",$_SESSION['session_web']['login_userName']);

        $valid_formats = array("jpg", "png", "gif", "bmp","jpeg" );
        $name = $_FILES['photoimg']['name'];
        $size = $_FILES['photoimg']['size'];
        if(strlen($name))
        {
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats))
        {
        if($size<(2048*1024)) // Image size max 2 MB
        {
			// Check for user directory 
			if (!file_exists("../upload/".str_replace(" ","_",$_SESSION['session_web']['login_userName']))) 
			{
				mkdir("../upload/".str_replace(" ","_",$_SESSION['session_web']['login_userName']),0777);
			}
        $actual_image_name = 'avatar' .'_'.$userId .'.'.$ext;
        $filePath = $path .'/'.$actual_image_name;
        $filePath1 = "upload/".str_replace(" ","_",$_SESSION['session_web']['login_userName'])."/".$actual_image_name;
        $tmp = $_FILES['photoimg']['tmp_name'];
        
        if(move_uploaded_file($tmp, $filePath))
        {
			include "connection.php";

			$width = getWidth($filePath);
            $height = getHeight($filePath);
            //Scale the image if it is greater than the width set above
            if ($width > $max_width){
                $scale = $max_width/$width;
                $uploaded = resizeImage($filePath,$width,$height,$scale);
            }else{
                $scale = 1;
                $uploaded = resizeImage($filePath,$width,$height,$scale);
            }
        /*$res = saveAvatar(array(
                        'userId' => isset($userId) ? intval($userId) : 0,
                                                'avatar' => isset($actual_image_name) ? $actual_image_name : '',
                        ));*/
                        
			mysqli_query($conn,"UPDATE users SET userphoto='$filePath1' WHERE user_id='".$_SESSION['session_web']['login_userId']."'") or die(mysqli_error($conn)."Error");
			echo "<img id='photo' file-name='".$actual_image_name."' class='' src='".$filePath1.'?'.time()."' class='preview'/>";
			$_SESSION['session_web']['login_userPhoto']=$filePath1;
        }
        else
        echo "failed";
        }
        else
        echo "Image file size max 2 MB"; 
        }
        else
        echo "Invalid file format.."; 
        }
        else
        echo "Please select image..!";
        exit;
        
        
    }
    /*********************************************************************
     Purpose            : update image.
     Parameters         : null
     Returns            : integer
     ***********************************************************************/
     function saveAvatarTmp() {
        $post = isset($_POST) ? $_POST: array();
        $userId = isset($post['id']) ? intval($post['id']) : 0;
        $path ='upload/';
        $t_width = 300; // Maximum thumbnail width
        $t_height = 300;    // Maximum thumbnail height
		
		if(isset($_POST['t']) and $_POST['t'] == "ajax")
		{
			extract($_POST);
			
			//$img = get_user_meta($userId, 'user_avatar', true);
			$imagePath = "../upload/".str_replace(" ","_",$_SESSION['session_web']['login_userName'])."/".$_POST['image_name'];
			$ratio = ($t_width/$w1); 
			$nw = ceil($w1 * $ratio);
			$nh = ceil($h1 * $ratio);
			$nimg = imagecreatetruecolor($nw,$nh);
			$im_src = imagecreatefromjpeg($imagePath);
			imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w1,$h1);
			imagejpeg($nimg,$imagePath,90);
			
		}
		echo "upload/".str_replace(" ","_",$_SESSION['session_web']['login_userName'])."/".$_POST['image_name']."?".time();;
		exit(0);    
    }
    
    /*********************************************************************
     Purpose            : resize image.
     Parameters         : null
     Returns            : image
     ***********************************************************************/
    function resizeImage($image,$width,$height,$scale) {
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);

	$source = imageCreateFromAny($image);
    imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
    imagejpeg($newImage,$image,90);
    chmod($image, 0777);
    return $image;
}

function imageCreateFromAny($image) { 
    $type = exif_imagetype($image); // [] if you don't have exif you could use getImageSize() 
    $allowedTypes = array(1,2,3,6);
	
    if (!in_array($type, $allowedTypes)) { 
        return false; 
    } 
    switch ($type) { 
        case 1 : 
            $source = imageCreateFromGif($image); 
        break; 
        case 2 : 
            $source = imageCreateFromJpeg($image); 
        break; 
        case 3 : 
            $source = imageCreateFromPng($image); 
        break; 
        case 6 : 
            $source = imageCreateFromBmp($image); 
        break; 
    }    
    return $source; 
	
} 

/*********************************************************************
     Purpose            : get image height.
     Parameters         : null
     Returns            : height
     ***********************************************************************/
function getHeight($image) {
    $sizes = getimagesize($image);
    $height = $sizes[1];
    return $height;
}
/*********************************************************************
     Purpose            : get image width.
     Parameters         : null
     Returns            : width
     ***********************************************************************/
function getWidth($image) {
    $sizes = getimagesize($image);
    $width = $sizes[0];
    return $width;
}

?>
