<?php
/**
 * User-related function definitions
 */

function admin_create_user($uid) {

 }

function admin_get_user($uid) {
  $retArray = [];

  $uid = clean_input($uid);

  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $sql = "SELECT user_id, user_name, user_email, user_date_reg, user_avatar, user_tagline, user_bio, user_role, user_reg_status FROM users WHERE user_id={$uid}";

 	$result = $conn->query($sql);

  if($result->num_rows == 1) {
    $retArray = $result->fetch_array(MYSQLI_ASSOC);
  } else {
    $retArray = array(
    array("user_id"=>0,"user_name"=>"Nobody","user_email"=>"nobody@nobody.com","user_date_reg"=>"00-00-0000 00:00", "user_avatar"=>"avatar_placeholder50x50.png","user_role"=>"None","user_reg_status"=>"Non-Existent")
    );
  }
  $conn->close();
  return $retArray;

}

function admin_update_user($userProfileData) {

}

function delete_admin_user($uid) {

}

function admin_update_user_pass($uid) {

}

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
    <td>{$user["user_name"]}</td>
    <td>{$user["user_email"]}</td>
    <td>{$user["user_date_reg"]}</td>
    <td><img src="../uploads/images/{$user["user_avatar"]}" class="avatar-image"/></td>
    <td>{$user["user_role"]}</td>
    <td>{$user["user_reg_status"]}</td>
    <td><a href="/admin/admin-users.php?action=manage&uid={$user["user_id"]}">Manage</a></td>
    </tr>
EOB;
  }

echo<<<EOB
  </tbody>
</div>
EOB;

}

function admin_display_user_manager(int $uid) {

$user = admin_get_user($uid);

echo <<<EOHTML
<form class="form" action="" method="POST" id="userProfileForm" enctype="multipart/form-data">

  <div class="form-row">

    <div class="col-lg-6">

      <div class="form-group">
      	<label for="user_name">Username:</label>
      	<input type="text" class="form-control" id="user_name" name="user_name" value="{$user["user_name"]}">
      </div>

      <div class="form-group">
        <img src="../../uploads/images/{$user["user_avatar"]}" class="profile-image"/>
      </div>


      <div class="form-group">
      	<label for="user_avatar">Avatar:</label>
      	<input type="file" class="form-control-file" id="user_avatar" name="user_avatar" value="">
      </div>

    </div>

    <div class="col-lg-6">

      <div class="form-group">
        <label for="user_tagline">Tagline:</label>
        <input type="text" class="form-control" id="user_tagline" name="user_tagline" value="{$user["user_tagline"]}">
      </div>

      <div class="form-group">
      	<label for="user_bio">About You:</label>
      	<textarea class="form-control user-bio" id="user_bio" name="user_bio" rows="15" style="max-width:500px;">
{$user["user_bio"]}
      	</textarea>
      </div>

    </div>

  </div>

  <div class="form-row">

    <div class="col-lg-6">
      <div class="form-group">
        <label for="user_password">Change Password:</label>
        <input type="password" class="form-control" id="user_password" name="user_password">
        <label for="user_password_confirm">Confirm Password:</label>
        <input type="password" class="form-control" id="user_password_confirm" name="user_password_confirm">
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form-group">

        <label for="user_email">Your Email:</label>
        <input type="text" class="form-control" id="user_email" name="user_email" value="{$user["user_email"]}">

        <br/>

        <input type="hidden" id="user_id" name="user_id" value="{$user["user_id"]}">
        <button class="btn btn-default" type="submit" name="editProfile" value="editProfile">Update profile</button>

      </div>
    </div>

  </div>

</form>
EOHTML;
}

 ?>
