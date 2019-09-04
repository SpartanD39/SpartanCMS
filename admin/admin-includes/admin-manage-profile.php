<?php
$uid_safe = $uid;
if(isset($_POST["editProfile"])) {

  $userProfileData["user_id"] = $uid_safe;
  $userProfileData["user_email"] = $_POST["user_email"];
  $userProfileData["user_name"] = $_POST["user_name"];
  $userProfileData["user_tagline"] = $_POST["user_tagline"];
  $userProfileData["user_bio"] = $_POST["user_bio"];

  /**
  * Check if the user is updating their password.If so, we set the value and
  * then call a function to update the password in the database separately,
  * if not, we set the value to null and then drop it entirely.
  */

  if(!empty($_POST["user_password"])) {
    $userProfileData["user_pass"] = $_POST["user_password"];
  } else {
    $userProfileData["user_pass"] = "";
  }

  /**
  * Here we check for upload of an avatar image so we can determine if it
  * needs to be updated later, setting the value to null if no file is uploaded,
  * or there is an error uploading the file.
  */
  if($_FILES["user_avatar"]["error"] != 4) {
  $avatar_image_name = $_FILES['user_avatar']['name'];
	$avatar_image_temp_name = $_FILES['user_avatar']['tmp_name'];
	move_uploaded_file($avatar_image_temp_name,"../uploads/images/{$avatar_image_name}");
  $userProfileData["user_avatar"] = $avatar_image_name;
} else {
  $userProfileData["user_avatar"] = null;
}
/**
* End file upload check
*/
  $user_update_task = admin_update_user($userProfileData);
  echo $user_update_task["message"];
} elseif (isset($_POST["deleteProfile"])) {
  admin_delete_user($uid_safe);
}

?>
<div class="col-lg-3">

</div>

<div class="col-lg-6">
<?php
  if(isset($uid)){

    admin_display_user_manager($uid);
  } else {
    header("Location: /admin/admin-users.php");
  }
?>
</div>

<div class="col-lg-3">

</div>
