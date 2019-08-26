<?php
define("CONFIGDIR", dirname(__FILE__));
define("DS", DIRECTORY_SEPARATOR);
if(!file_exists(CONFIGDIR . DS . "db-config.php")) {
	header("Location: /installer/installer.php");
}
include(CONFIGDIR . DS . "db-config.php");

function clean_input($data) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$conn->real_escape_string($data);
	return $data;	
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

include("functions/posts-functions.php");
include("functions/category-functions.php");
include("functions/search-functions.php");
include("functions/comments-functions.php");



?>
