<?php 
include("includes/database.php");
include("includes/header.php");
include("includes/navbar.php");
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
				
				<?php
				
				if(isset($_POST["submit"]) && isset($_POST["searchterm"])) {
						$searchterm = clean_input($_POST["searchterm"]);
						
						$searchResults = doSearch($searchterm);
						displaySearch($searchResults);
					} else {
						if(isset($_GET['id']) && isset($_GET['view'])) {
							switch($_GET['view']) {
								case "post":
								include("includes/post.php");
								break;
								
								case "category":
								include("includes/category.php");
								break;
								
								default:
								display_posts_front();
								
							}
						} else {
							display_posts_front();
						}						
					}
				?>
				
                <hr>
            </div>

<?php 
include("includes/sidebar.php");
include("includes/footer.php");
?>