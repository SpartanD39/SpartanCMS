<?php
include("db-config.php");

function clean_input($data) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$conn->real_escape_string($data);
	return $data;	
}


include("functions/posts-functions.php");
include("functions/category-functions.php");
include("functions/search-functions.php");
include("functions/comments-functions.php");



?>
