<?php
include("database.php");
if(!empty($_POST["postData"])) {
	$status = add_post_comment($_POST["postData"]);
	echo $status["message"];
}


?>
