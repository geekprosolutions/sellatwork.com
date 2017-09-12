<?php
/*ob_start();
session_start();

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<pre>";
print_r($_COOKIE);
echo "</pre>";
*/
if(!empty($_POST['latitude']) && !empty($_POST['longitude']))
{
	setcookie("UserLatitude",$_POST['latitude'], time() + (86400 * 30), "/" );
	setcookie("UserLongitude",$_POST['longitude'], time() + (86400 * 30), "/" );
	setcookie("UserCity",$_POST['city'], time() + (86400 * 30), "/" );
	setcookie("UserState",$_POST['state'], time() + (86400 * 30), "/" );
	setcookie("UserCountry",$_POST['countryName'], time() + (86400 * 30), "/" );
	setcookie("UserLocation",$_POST['user_location'], time() + (86400 * 30), "/" );
}
else
{	
	setcookie("UserLatitude",37.386052, time() + (86400 * 30), "/" );
	setcookie("UserLongitude",-122.083851, time() + (86400 * 30), "/" );
	setcookie("UserCity","Mountain View", time() + (86400 * 30), "/" );
	setcookie("UserState","California", time() + (86400 * 30), "/" );
	setcookie("UserCountry","United States", time() + (86400 * 30), "/" );
	setcookie("UserLocation","Mountain View, California, U.S", time() + (86400 * 30), "/" );
}
?>