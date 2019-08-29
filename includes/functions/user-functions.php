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
      array("user_id"=>0,"user_name"=>"Nobody","user_email"=>"nobody@nobody.com","user_date_reg"=>"00-00-0000 00:00", "user_avatar"=>"avatar_placeholder50x50.png","user_role"=>"None","user_reg_status"=>"Non-Existent")
    );
 	}
 	$conn->close();
 	return $retArray;
 }

 /**
  * Displays users to the admin in the admin area.
  *
  * @return void
  */

function admin_display_users() {

  $usersAll = get_all_users();

echo<<<EOB
    <div class="col-lg-12">
        <table class="table" id="userTable">
          <thead>
            <tr>
              <th scope="col">UserID:</th>
              <th scope="col">Username:</th>
              <th scope="col">Email:</th>
              <th scope="col">Date Joined:</th>
              <th scope="col">Avatar:</th>
              <th scope="col">Role:</th>
              <th scope="col">Status:</th>
              <th scope="col"></th>
            </tr>
          </thead>

          <tbody>
EOB;

  foreach($usersAll as $user) {
    echo<<<EOB
    <tr>
    <td>{$user["user_id"]}</td>
    <td>{$user["user_name"]}</td>
    <td>{$user["user_email"]}</td>
    <td>{$user["user_date_reg"]}</td>
    <td><img src="../uploads/images/{$user["user_avatar"]}" /></td>
    <td>{$user["user_role"]}</td>
    <td>{$user["user_reg_status"]}</td>
    <td><a href="#">Manage</a></td>
    </tr>
EOB;
  }

echo<<<EOB
  </tbody>
</div>
EOB;

}

 ?>
