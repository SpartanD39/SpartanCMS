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
      <div class="col-lg-12">
          <table class="table" id="commentTable">
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
              <?php admin_display_users(); ?>
            </tbody>
      </div>
    </div>
  </div>
</div>

<?php
include("admin-includes/admin-footer.php");
?>
