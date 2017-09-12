<?php
ob_start();
session_start();

$username=$_SESSION['session_web']['login_userName'];
$userId=$_SESSION['session_web']['login_userId'];
$pro_id=$_GET['e'];

use Hazzard\Filepicker\Handler;
use Hazzard\Filepicker\Uploader;
use Intervention\Image\ImageManager;
use Hazzard\Config\Repository as Config;

// Include composer autoload
require __DIR__.'/../vendor/autoload.php';
$uploader = new Uploader($config = new Config, new ImageManager(array('driver' => 'gd')));
$handler = new Handler($uploader);

// Configuration
$config['debug'] = true;
$config['upload_dir'] = __DIR__.'/../../upload/album_'.$_SESSION['session_web']['login_userId'];
$config['upload_url'] = 'upload/album_'.$_SESSION['session_web']['login_userId'];
$config['image_versions.thumb'] = array(
    'width' => 120,
    'height' => 120
);

// Events
/**
 * Fired before the file upload starts.
 *
 * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
 */
$handler->on('upload.before', function ($file) 
{
     $file->save = 'pro_'.mt_rand(900,90000);
	 $ext=$file->getClientOriginalExtension();
	 $array=array("jpg","JPG","JPEG","png","PNG","bmp","BMP");
	if (in_array($ext, $array))
	{
	}
	else
	{
		throw new \Hazzard\Filepicker\Exception\AbortException('File Format Not Supported');
	}
});

    // throw new \Hazzard\Filepicker\Exception\AbortException('Error message!');

/**
 * Fired on upload success.
 *
 * @param \Symfony\Component\HttpFoundation\File\File $file
**/

$handler->on('upload.success', function ($file) {

// $conn=mysqli_connect("localhost","root","");
// $db=mysqli_select_db($conn,"sellatwork");

/* Database Connection For Server */
$conn=mysqli_connect("localhost","geekpro","geekpro1");
$db=mysqli_select_db($conn,"sellatwork");
$sql_query=mysqli_query($conn,"select url_root from admin ");
$result=mysqli_fetch_array($sql_query);
//$url_root="http://localhost/SELL8work/";
$url_root=$result['url_root'];

$filename=$url_root."upload/album_".$_SESSION['session_web']['login_userId']."/".$file->getFilename();

$sql=mysqli_query($conn,"select pro_image,category from products where product_id='".$_GET['e']."' and user_id='".$_SESSION['session_web']['login_userId']."' ") or die (mysqli_error($conn));
$fetch=mysqli_fetch_array($sql);
$images=$fetch['pro_image'];
$category=$fetch['category'];
if($images=="" || $images==" ")
{
	$new_image=$filename;
}
else
{
	$new_image=$images.",".$filename;
}

$new_Array1=explode(",",$new_image);
$default_image=$url_root."upload/Categories/".str_replace(" ","_",$category)."/default_productImage.png";
$new_array = array_diff($new_Array1, array($default_image));
$new_image=implode(",",$new_array);
$sql1=mysqli_query($conn,"update products set pro_image='$new_image' where product_id='".$_GET['e']."' and user_id='".$_SESSION['session_web']['login_userId']."' ") or die (mysqli_error($conn));

});




/**
 * Fired on upload error.
 *
 * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
**/

$handler->on('upload.error', function ($file) {

});

/**
 * Fired when fetching files.
 *
 * @param array &$files
 */
$handler->on('files.fetch', function (&$files) 
{
	
// $conn=mysqli_connect("localhost","root","");
// $db=mysqli_select_db($conn,"sellatwork");

/* Database Connection For Server */
$conn=mysqli_connect("localhost","geekpro","geekpro1");
$db=mysqli_select_db($conn,"sellatwork");

$sql_query=mysqli_query($conn,"select url_root from admin ");
$result=mysqli_fetch_array($sql_query);
//$url_root="http://localhost/SELL8work/";
$url_root=$result['url_root'];
    // Set the array of files to be returned.
	$sql=mysqli_query($conn,"select pro_image from products where product_id='".$_GET['e']."' and user_id='".$_SESSION['session_web']['login_userId']."' ") or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($sql);
	$images=explode(",",$fetch['pro_image']);
	$files = $images;
});

/**
 * Fired on file filtering.
 *
 * @param array &$files
 * @param int   &$total
 */
$handler->on('files.filter', function (&$files, &$total) {

});

/**
 * Fired on file download.
 *
 * @param \Symfony\Component\HttpFoundation\File\File $file
 * @param string $version
 */
$handler->on('file.download', function ($file, $version) {

});

/**
 * Fired on file deletion.
 *
 * @param \Symfony\Component\HttpFoundation\File\File $file
 */
$handler->on('file.delete', function ($file)
{
	
// $conn=mysqli_connect("localhost","root","");
// $db=mysqli_select_db($conn,"sellatwork");

/* Database Connection For Server */
$conn=mysqli_connect("localhost","geekpro","geekpro1");
$db=mysqli_select_db($conn,"sellatwork");

$sql_query=mysqli_query($conn,"select url_root from admin ");
$result=mysqli_fetch_array($sql_query);
//$url_root="http://localhost/SELL8work/";
$url_root=$result['url_root'];

$filename=$url_root."upload/album_".$_SESSION['session_web']['login_userId']."/".$file->getFilename();
$sql=mysqli_query($conn,"select pro_image,category from products where product_id='".$_GET['e']."' and user_id='".$_SESSION['session_web']['login_userId']."' ") or die (mysqli_error($conn));
$fetch=mysqli_fetch_array($sql);

$images=explode(",",$fetch['pro_image']);
$new_array = array_diff($images, array($filename));
$new_image=implode(",",$new_array);
$category=$fetch['category'];

if(strlen($new_image)<10)
{
	$new_image=$url_root."upload/Categories/".str_replace(" ","_",$category)."/default_productImage.png";
}

$sql1=mysqli_query($conn,"update products set pro_image='$new_image' where product_id='".$_GET['e']."' and user_id='".$_SESSION['session_web']['login_userId']."' ") or die (mysqli_error($conn));

});

/**
 * Fired before cropping.
 *
 * @param \Symfony\Component\HttpFoundation\File\File $file
 * @param \Intervention\Image\Image $image
 */
$handler->on('crop.before', function ($file, $image) {

});

/**
 * Fired after cropping.
 *
 * @param \Symfony\Component\HttpFoundation\File\File $file
 * @param \Intervention\Image\Image $image
 */
$handler->on('crop.after', function ($file, $image) {

});

// Handle the request.
$handler->handle()->send();
