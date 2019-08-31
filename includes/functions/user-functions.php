<?php
/**
 * User-related function definitions
 */

function validate_user_privs() {

}

function admin_create_user($userInfoArray) {
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if(validate_new_user($userInfoArray)) {

    $user_name = clean_input($userInfoArray["user_name"]);

    $user_email = clean_input($userInfoArray["user_email"]);

    $user_date_reg = date('d-m-y H:i');

    $user_avatar = "profile_placeholder300x300.png";

    $user_role = "author";

    $user_reg_status = "pending";

    $user_pass = clean_input($userInfoArray["user_password"]);

    $cryptPass = password_hash($user_pass, PASSWORD_DEFAULT);

    $userSql = "INSERT INTO users (user_name,user_email,user_date_reg,user_avatar,user_role,user_reg_status,user_pass) VALUES ('{$user_name}','{$user_email}','{$user_date_reg}','{$user_avatar}','{$user_role}','{$user_reg_status}','{$cryptPass}')";

    if($conn->query($userSql)) {

/*
      $mailTo = $user_email;

      $mailSubject = "New registration details from spartancms.local";

      $mailMessage = "You've been granted acccess to the site mentioned in the subject of this email. \r\nYour usename is {$user_name}.\r\nYour password is {$user_pass}.\r\nIt is highly encouraged that you change your password as soon as possible via your profile edit screen.";

      $mailHeaders = "From: admin@spartancms.local\r\nReply-To: noreply@spartancms.local\r\nX-Mailer: PHP/" .phpversion();

      mail($mailTo,$mailSubject,$mailMessage,$mailHeaders);
*/
      //return true if the user is created
      $retval = 1;

    } else {
      //retrun false if there's an error creating the user
      $retval = 0;
    }

  } else {
    //return false if the user already exists.
    $retval = 0;
  }

  $conn->close();
  return $retval;

}

function validate_new_user($userInfoArray) {

  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $user_name = clean_input($userInfoArray["user_name"]);

  $user_email = clean_input($userInfoArray["user_email"]);

  $sql = "SELECT user_id FROM users WHERE user_name='{$user_name}' OR user_email='{$user_email}'";

  $result = $conn->query($sql);

  if($result->num_rows < 1) {
    $retval = 1;
  } else {
    $retval = 0;
  }

  $conn->close();

  return $retval;

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

  $user_id = clean_input($userProfileData["user_id"]);
  $user_email = clean_input($userProfileData["user_email"]);
  $user_name = clean_input($userProfileData["user_name"]);
  $user_tagline = clean_input($userProfileData["user_tagline"]);
  $user_bio = clean_input($userProfileData["user_bio"]);
  $user_avatar = clean_input($userProfileData["user_avatar"]);

  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $sql = "UPDATE users SET
          user_email='{$user_email}',
          user_name='{$user_name}',
          user_tagline='{$user_tagline}',
          user_bio='{$user_bio}'";
  if(!empty($user_avatar)) {
    $sql .= ",user_avatar='{$user_avatar}'";
  }

  $sql .= " WHERE user_id={$user_id}";

  $result = $conn->query($sql);

  if($result === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "<div class=\"alert alert-success alert-dismissible show\" role=\"alert\">Profile Updated!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Error!" . $conn->error . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	}

  $conn->close();

  return $retArray;

}

function admin_delete_user($uid) {

  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $uid = clean_input($uid);

  $sql = "DELETE FROM users where user_id={$uid}";

  if($conn->query($sql)) {
    header("Location: /admin/admin-users.php");
  } else {
    echo "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Error!" . $conn->error . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
  }
  $conn->close();
}

/**
* WARNING! BELOW ARE USER-DEFINED LOGIN AND PASSWORD FUNCTIONS
* DO NOT MODIFY THESE FUNCTIONS UNLESS YOU HAVE A VERY COMPELLING
* REASON TO DO SO.
* Most of these functions will only be called in the context of another
* function, or group of functionality.
*/

/**
* Sets the user password on user creation. The initial user function will
* create the user in the database, and this function will be called to encrypt
* and put the password in the database.
*
*/
function admin_set_user_pass($uid, $newPass) {

  $uid = clean_input($uid);

  $newPass = clean_input($newPass);

  $cryptPass = password_hash($newPass, PASSWORD_DEFAULT);

  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $sql = "UPDATE users SET user_pass='{$cryptPass}'";

  $result = $conn->query($sql);

  if($result === TRUE) {
    $retval = 1;
  } else {
    $retval = 0;
  }

  $conn->close();

  return $retval;

}

function admin_update_user_pass($uid, $oldPass, $newPass) {

  $uid = clean_input($uid);
  $oldPass = clean_input($oldPass);

  $newPass = clean_input($newPass);
  $newPass = password_hash($newPass, PASSWORD_DEFAULT);

  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $getPassSQL = "SELECT user_password FROM users WHERE user_id={$uid}";
  $getPassRes = $conn->query($getPassSQL);
  if($getPassRes->num_rows == 1) {
    $hashedPass = $getPassRes->fetch_array(MYSQLI_ASSOC);
  } else {
    $conn->close();
    die("Critical application error. Please submit a report to the dev.");
  }

  if(password_verify($oldPass, $hashedPass["user_pass"])) {

    $updatePassSQL = "UPDATE users SET user_pass={$newPass} WHERE user_id={$uid}";
    $updatePassRes = $conn->query($updatePassSQL);
  } else {
    $conn->close();
    die("Critical application error. Please submit a report to the dev.");
  }

  if($updatePassRes === TRUE) {
    $retval = 1;
  } else {
    $conn->close();
    die("Critical application error. Please submit a report to the dev.");
  }

  $conn->close();

  return $retval;

}

function login_validate_user_pass($username, $userpass) {

  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  $username = clean_input($username);
  $userpass = clean_input($userpass);

  $passSql = "SELECT user_pass FROM users WHERE user_name='{$username}' OR user_name='{$username}' LIMIT 1";

  $passRes = $conn->query($passSql);

  if($passRes->num_rows == 1) {
    $passCrypt = $passRes->fetch_array(MYSQLI_ASSOC);
    if(password_verify($userpass, $passCrypt)) {
      $retval = 1;
    } else {
      $retval = 0;
    }
  } else {
    $retval = 0;
  }

  $conn->close();
  return $retval;

}

function create_user_session($username, $userpass) {

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
              <th scope="col">
              				<a href="/admin/admin-users.php?action=create"><button class="btn btn-secondary">Create User</button></a>
              			</th>
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

/**
* Displays the users profile and gives options to manage it.
* @param int $uid user ID to get.
*
* @return void
*/

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
      	<input type="file" class="form-control-file" id="user_avatar" name="user_avatar" value="{$user["user_avatar"]}">
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

        <button class="btn btn-default" type="submit" name="editProfile" value="editProfile">Update profile</button>
        <button class="btn btn-danger pull-right confirmProfileDelete" type="submit" name="deleteProfile" value="deleteProfile">Delete profile</button>

      </div>
    </div>

  </div>

</form>
EOHTML;

return $user["user_id"];
}

 ?>
