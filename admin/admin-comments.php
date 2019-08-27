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
			
			if(isset($_GET['action']) && !empty($_GET['commentID'])) {
			$action = $_GET['action'];
			$comment_id = $_GET['commentID'];

			switch($action) {
				case "delete":
					$status = admin_delete_comment($comment_id);
					header("Location: /admin/admin-comments.php");
				break;
				
				case "status":
					if(isset($_GET['commentID']) && isset($_GET['commentStatus'])) {
						$comment_id = $_GET['commentID'];
						$comment_status = $_GET['commentStatus'];
						admin_change_comment_status($comment_id, $comment_status);
						header("Location: /admin/admin-comments.php");
					}
				break;
					
				default: 
				echo <<<EOT
				<div class="col-lg-12">
						<table class="table" id="commentTable">
							<thead>
								<tr>
									<th scope="col">Post:</th>
									<th scope="col">Date:</th>
									<th scope="col">Name:</th>
									<th scope="col">Author email:</th>
									<th scope="col">Author IP:</th>
									<th scope="col">Comment:</th>
									<th scope="col">Status:</th>
								</tr>
							</thead>
							
							<tbody>
EOT;
								
								admin_display_comments();
								
				echo <<<EOT
							
							</tbody>
						</table>
						
					</div>
EOT;
			}
		} else {
					echo <<<EOT
				<div class="col-lg-12">
						<table class="table" id="commentTable">
							<thead>
								<tr>
									<th scope="col">Post:</th>
									<th scope="col">Date:</th>
									<th scope="col">Name:</th>
									<th scope="col">Author email:</th>
									<th scope="col">Author IP:</th>
									<th scope="col">Comment:</th>
									<th scope="col">Status:</th>
								</tr>
							</thead>
							
							<tbody>
EOT;
								
								admin_display_comments();
								
				echo <<<EOT
							
							</tbody>
						</table>
						
					</div>
EOT;
		}
			
			?>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php
include("admin-includes/admin-footer.php");
?>