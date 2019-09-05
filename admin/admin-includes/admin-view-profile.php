<?php
if(isset($_GET["uid"]) && !empty($_GET["uid"])) {
  $uid = $_GET["uid"];
  $user = admin_get_user($uid);
} else {
  echo<<<EOHTML

<div class="col-lg-3">

</div>

<div class="col-lg-6">

</div>

<div class="col-lg-3">

</div>

EOHTML;
}

?>
<div class="col-lg-3">

</div>

<div class="col-lg-6">

    <img class="profile-image" src="../../uploads/images/<?php echo $user["user_avatar"];?>" alt="Generic placeholder image">
    <div class="media-body">
      <h3 class="">Hi there, I'm <?php echo $user["user_name"]; ?></h3>
      <h4 class="">"<?php echo $user["user_tagline"];?>"</h4>
      <p class=""><?php echo $user["user_bio"];?></p>
    </div>

</div>

<div class="col-lg-3">

</div>
