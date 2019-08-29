<?php
/**
 * User-related function definitions
 */

/**
 * Gets all users from the database.
 *
 * @return array
 */
 function get_all_users() {
 	$retArray = [];

  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $sql = "SELECT user_id, user_name, user_email, user_date_reg, user_avatar, user_role, user_reg_status FROM users";

 	$result = $conn->query($sql);

  if($result->num_rows > 0) {
 		$retArray = $result->fetch_all(MYSQLI_ASSOC);
 	} else {
 		$retArray = array(
      array("user_id"=>0,"user_name"=>"Nobody","user_email"=>"nobody@nobody.com","user_date_reg"=>"00-00-0000 00:00", "user_avatar"=>"avatar_placeholder50x50.png","user_role"=>"None","user_reg_status"=>"Non-Existent");
    );
 	}
 	$conn->close();
 	return $retArray;
 }

 ?>
