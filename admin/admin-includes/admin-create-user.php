<?php
if(isset($_POST["createUser"]) && !empty($_POST["user_name"]) && !empty($_POST["user_email"])) {
  $userInfoArray["user_name"] = $_POST["user_name"];
  $userInfoArray["user_email"] = $_POST["user_email"];
  $userInfoArray["user_password"] = $_POST["user_password"];
  if(admin_create_user($userInfoArray)) {
    echo<<<EOHTML
<div class="alert alert-success alert-dismissible show" role="alert">Profile Created!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button> </div><br/>
EOHTML;
  } else {
    echo<<<EOHTML
<div class="alert alert-danger alert-dismissible show" role="alert">Error making profile!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button> </div><br/>
EOHTML;
  }
}
?>


<div class="col-lg-3">

</div>

<div class="col-lg-6">
  <h4>Create a new user below. Once submitted, an email will be sent to the user with their login credentials.</h4>

  <div class="alert alert-danger alert-dismissible collapse" id="userFormStatus" role="alert">Passwords need to match!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button> </div>

  <br/>

  <form class="form" action="" method="POST" id="userCreateForm" onsubmit="passwords_match()">

    <div class=form-group>
      <label for="user_name">Username:</label>
      <input type="text" name="user_name" id="user_name" required />
    </div>

    <div class=form-group>
      <label for="user_email">User email:</label>
      <input type="email" name="user_email" id="user_email" required />
    </div>

    <div class=form-group>
      <label for="user_email">User password:</label>
      <input type="password" name="user_password" id="user_password" required />
    </div>

    <div class=form-group>
      <label for="user_email">User password:</label>
      <input type="password" name="user_password_confirm" id="user_password_confirm" required />
    </div>


    <button class="btn btn-primary" name="createUser" id="createUserBtn">Create User</button>

  </form>
</div>

<div class="col-lg-3">

</div>
