<?php
/* Database Connection For Localhost */	
// $conn=mysqli_connect("localhost","root","");
// $db=mysqli_select_db($conn,"sellatwork");

/* Database Connection For Server */
$conn=mysqli_connect("localhost","geekpro","geekpro1");
$db=mysqli_select_db($conn,"sellatwork");

date_default_timezone_set("Asia/Calcutta");
$current_date_time=date("d-m-Y h:i:s a");
$current_date=date("d-m-Y");
$current_time=date("h:i:s a");
$current_year=date("Y");
$current_month=date("m");

if(!$db)
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Connection Error</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="sellatwork, buy, sell, products" />
<!-- Custom Theme files -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
	 body{  background-image: url("https://s-media-cache-ak0.pinimg.com/564x/ea/e5/f6/eae5f6b58765950f7b13241a561b25fa.jpg");   background-repeat: no-repeat;  background-size: 100% 200%;color: #fff; float: left;height: 100%; width: 100%; }
	 body a {  background-color: #29a4fe;
    border-radius: 4px;
    color: #fff;
    padding: 5px 12px;}
	 h2{   font-family: "Offside",cursive;
    font-size: 5em;
    font-weight: 700;
    text-transform: uppercase; }
</style>
</head>
<body>
<div class="clearfix"></div>
<div class="container 4error">
	<div class="content_fullwidth">
		<div style="text-align:center;margin-top:10%;">
        <h2>1044 Error</h2>
        <br />
    	<b>Access Denied!</b><br/>
        
        <em>Sorry Could not connect to database </em>

        <h3>Access denied for user 'user'@'localhost' to database 'db' </h3>
        
        <div class="clearfix margin_top3"></div>
		<div style="margin-top:1em;">
    	<a href="<?php echo $_SERVER['PHP_SELF'] ;?>" class="but_goback"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; Try Again</a>
        </div>
    </div>
        
</div>
</div>
</body>
</html>
<?php
die;
}
$sql_query=mysqli_query($conn,"select url_root from admin ");
$result=mysqli_fetch_array($sql_query);
// $url_root="http://localhost/SELL8work/";
$url_root=$result['url_root'];

ob_start();
session_start();
?>