<?php
include("admin-includes/admin-header.php");
include("admin-includes/admin-navbar.php");
include("admin-includes/admin-sidebar.php");
?>

<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					Admin Panel
					<small>Hello Spartan!</small>
				</h1>
			</div>
		</div>
		<!-- /.row -->
    <div class="row">
    <?php

      if(isset($_GET["action"])) {

        $action = htmlspecialchars($_GET["action"]);

        switch($action) {
          case "manage":
            include("admin-includes/admin-manage-profile.php");
            break;

          default:
            admin_display_users();
            break;
        }

      } else {
        admin_display_users();
      }

    ?>
    </div>
  </div>

<?php
include("admin-includes/admin-footer.php");
?>
