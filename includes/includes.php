<?php
define("DS", DIRECTORY_SEPARATOR);
define("CONFIG_DIR", dirname(__FILE__) . DS);
define("FRONT_FUNCS_DIR", CONFIG_DIR . "functions" . DS);

if(!file_exists(CONFIG_DIR . "db-config.php")) {
	header("Location: /installer/installer.php");
}
include(CONFIG_DIR . "db-config.php");

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

include(FRONT_FUNCS_DIR . "posts-functions.php");
include(FRONT_FUNCS_DIR . "category-functions.php");
include(FRONT_FUNCS_DIR . "search-functions.php");
include(FRONT_FUNCS_DIR . "comments-functions.php");



?>
