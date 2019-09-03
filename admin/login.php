<?php
ob_start();
include("../includes/includes.php");

if(isset($_POST["login"])) {

  if(isset($_POST["user_name"]) && isset($_POST["user_pass"])) {

    $user_name = $_POST["user_name"];

    $user_pass = $_POST["user_pass"];

    $loginTask = login_validate_user_pass($user_name, $user_pass);

    if ($loginTask["status"] === 1) {

      $sessionTask = create_user_session($loginTask["uid"]);
      var_dump($_SESSION);

    } else {

      echo "Something is borked!";

    }

  }

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Bootstrap Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div id="login-wrapper">

      <div id="page-wrapper">

        <div class="container-fluid">

          <div class="row">

            <div class="col-lg-4">

            </div>

            <div class="col-lg-4">

              <h3 class="text-center">Welcome! Enter your login details below:</h3>

              <div class="well">

                <form class="form-horizontal" id="loginForm" action="" method="POST">

                  <div class="form-row">
                    <div class="col">
                      <div class="form-group">
                        <label for="user_name">Username:</label>
                        <input type="text" class="form-control" name="user_name" id="user_name" />
                      </div>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <div class="form-group">
                        <label for="user_pass">Password:</label>
                        <input type="password" class="form-control" name="user_pass" id="user_pass" />
                      </div>
                    </div>
                  </div>

                <button class="btn" type="submit" name="login" value="login">Login</button>

                </form>

              </div>

            </div>

            <div class="col-lg-4">

            </div>

          </div>

        </div>

      </div>
      <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="admin-includes/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="js/admin-edit.js"></script>
    <script type="text/javascript" src="js/admin-js.js"></script>
  </body>
</html>
