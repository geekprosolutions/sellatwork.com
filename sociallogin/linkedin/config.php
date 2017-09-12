<?php
include "../../backpages/connection.php";
$baseURL = $url_root.'sociallogin/linkedin/';
$callbackURL = $url_root.'sociallogin/linkedin/process.php';
$linkedinApiKey = '86hb8von6h7yuq';
$linkedinApiSecret = 'dvwRyqdF0M10XolG';
$linkedinScope = 'r_basicprofile r_emailaddress';

// for full profile visit  :  https://www.linkedin.com/help/linkedin/ask/API-DVR?lang=en , http://www.codexworld.com/login-with-linkedin-using-php/
?>