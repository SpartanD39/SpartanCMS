<?php
include("admin-includes/admin-header.php");
include("admin-includes/admin-navbar.php");
include("admin-includes/admin-sidebar.php");
?>

<div id="page-wrapper">
   <div class=container-fluid">
		<!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Posts Manager
                        <small>Hello Spartan!</small>
                    </h1>
                </div>
			</div>
        <!-- /.row -->
        <div class="row">


<?php

if(isset($_GET['action']) && !empty($_GET['action'])) {
    //handling/routing for post view/edit/creation.
    $action = $_GET['action'];
	if(isset($_GET['id'])) {
		$post_id = $_GET['id'];
	} else {
		$post_id = NULL;
	}

	switch($action) {
		case "new":
		include("admin-includes/admin-add-post.php");
		break;

		case "edit":
		include("admin-includes/admin-edit-post.php");
		break;

		case "delete":
		include("admin-includes/admin-delete-post.php");
		break;

		default:
		header("Location: admin-post.php");
	}
} else {
//header of our display table here
?>
			<div class="col-lg-12">
				<!---Post table--->
				<table class="table">
					<!---Post table header--->
					<thead class="thead-dark">
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Author</th>
							<th scope="col">Post Name</th>
							<th scope="col">Category</th>
							<th scope="col">Tags</th>
							<th scope="col">Image</th>
							<th scope="col">Status</th>
							<th scope="col">Created</th>
							<th scope="col"></th>
							<th scope="col"></th>
						</tr>
					</thead>
					<!---/Post table header--->
<?php
    $posts = get_all_posts();
    foreach($posts as $post) {
		$post["post_date"] = date('d-m-y H:i',strtotime($post["post_date"]));
        echo<<<EOT
        <tr>
            <td>{$post["post_id"]}</td>
            <td>{$post["post_author"]}</td>
            <td>{$post["post_title"]}</td>
            <td>{$post["cat_name"]}</td>
			<td>{$post["post_tags"]}</td>
			<td><img src="../uploads/images/{$post["post_image"]}" alt="" class="img-thumbnail" style="height: auto; width: auto; max-height: 150px; max-width: 150px;"></td>
			<td>{$post["post_status"]}</td>
			<td>{$post["post_date"]}</td>
            <td><a href="../index.php?id={$post["post_id"]}&view=post" target="_blank">View</a></td>
            <td><a href="admin-post.php?id={$post["post_id"]}&action=edit">Edit</a></td>
            <td><a href="admin-post.php?id={$post["post_id"]}&action=delete">Delete</a></td>
        </tr>
EOT;
    }
}
?>
				</table>
				<!---/Post table--->
            </div>
        </div>
    </div>
</div>
<?php
include("admin-includes/admin-footer.php");
?>
