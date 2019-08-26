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
							<th scope="col">Post:</th>
							<th scope="col">Comment Author:</th>
							<th scope="col">Author email:</th>
							<th scope="col">Comment:</th>
							<th scope="col">Status:</th>
						</tr>
					</thead>
					
					<tbody>
						
						<?php
						//TODO display comments
						?>
					
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php
include("admin-includes/admin-footer.php");
?>