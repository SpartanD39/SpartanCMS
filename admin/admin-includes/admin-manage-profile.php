<?php
if(isset($_POST["editProfile"])) {

  $userProfileData["user_id"] = $_POST["user_id"];
  $userProfileData["user_email"] = $_POST["user_email"];
  $userProfileData["user_name"] = $_POST["user_name"];
  $userProfileData["user_tagline"] = $_POST["user_tagline"];
  $userProfileData["user_bio"] = $_POST["user_bio"];

  /**
  * Check if the user is updating their password.If so, we set the value and
  * then call a function to update the password in the database separately,
  * if not, we set the value to null and then drop it entirely.
  */
  $userProfileData["user_pass"] = $_POST["user_password"];
  if(!empty($userProfileData["user_pass"])) {
    //admin_update_user_pass($userProfileData["user_id"], $userProfileData["user_pass"]);
    unset($userProfileData["user_pass"]);
  } else {
    unset($userProfileData["user_pass"]);
  }

  /**
  * Here we check for upload of an avatar image so we can determine if it
  * needs to be updated later, setting the value to null if no file is uploaded,
  * or there is an error uploading the file.
  */
  if($_FILES["user_avatar"]["error"] != 0 && $_FILES["user_avatar"]["error"] != 4) {
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
  admin_update_user($userProfileData);
}

?>
<div class="col-lg-3">

</div>

<div class="col-lg-6">
<?php
  if(isset($uid)){
    admin_display_user_manager($uid);
  }
?>
</div>

<div class="col-lg-3">

</div>
