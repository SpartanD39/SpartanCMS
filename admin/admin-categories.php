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
					<div class="col-lg-6">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="form">
							<div class="form-group">
								<label for="newcategory">Add new category:</label>
								<input type="text" name="newcategory" class="form-control">
							</div>
							<button name="submit" value="submit" class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-save"></span> Add Category
							</button>
						</form>
						<br/>
						<?php 
							if(isset($_POST["submit"])) {
								if($_POST["newcategory"] == "" || empty($_POST["newcategory"])) {
									echo "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">You need to provide a name!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
								} else {
									$added_category = add_category($_POST["newcategory"]);
									echo "<div class=\"alert alert-success alert-dismissible show\" role=\"alert\">" . $added_category["message"] . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
								}
							}
							
							// For the below form.
						?>
						
						<?php 
						if(isset($_GET["update"])) {
							include("admin-includes/admin-edit-category.php");
						} 
						
						if(isset($_POST["updatesubmit"])) {
							if(empty($_POST["updatecategory"]) || $_POST["updatecategory"] == "" ) {
								include("admin-includes/admin-edit-category.php");
								echo "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Invalid entry!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
							} else {
								update_category($_POST["cat_id"], $_POST["updatecategory"]);
								header("Location: admin-categories.php");
							}
						}
						
						 
						if(isset($_GET["delete"])) {
							$deleted_post = delete_category($_GET["delete"]);
							header("Location: admin-categories.php");
						}
						
						?>
						
						
					</div>
					
					<div class="col-lg-6">
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Name</th>
									<th scope="col"></th>
								</tr>
							</thead>
							
							<tbody>
							<?php
								$categories = get_categories();
								display_admin_categories($categories);								
							?>
							</tbody>
						</table>
					</div>
					
				</div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php
include("admin-includes/admin-footer.php");
?>