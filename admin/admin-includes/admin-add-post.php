<div class="col-lg-11">
<?php
if(isset($_POST["addPost"])) {
	$post_complete = [];
	$post_complete["post_cat_id"] = $_POST["post_cat_id"];
	$post_complete["post_title"] = $_POST["post_title"];
	$post_complete["post_author"] = $_POST["post_author"];
	$post_complete["post_date"] = date('d-m-y H:i');

	$post_image_name = $_FILES['post_image']['name'];
	$post_image_temp_name = $_FILES['post_image']['tmp_name'];
	move_uploaded_file($post_image_temp_name,"../uploads/images/{$post_image_name}");

	$post_complete["post_image"] = $post_image_name;

	$post_complete["post_content"] = $_POST["post_content"];
	$post_complete["post_comment_count"] = 0;
	$post_complete["post_tags"] = $_POST["post_tags"];
	$post_complete["post_status"] = $_POST["post_status"];
	$post_complete["post_comment_status"] = $_POST["post_comment_status"];

	$post_task = create_post($post_complete);
	if($post_task["status"] == 1) {
		echo $post_task["message"];
	} else {
		echo $post_task["message"];
	}
}

?>
<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
	<label for="post_author">Author:</label>
	<input type="text" class="form-control" id="post_author" name="post_author">
</div>

<div class="form-group">
	<label for="post_cat_id">Post Category:</label>
	<select class="form-control" id="post_cat_id" name="post_cat_id">
		<?php
		$categories = get_categories();
		foreach($categories as $category) {
			echo "<option value=\"{$category["cat_id"]}\"";
			echo ">{$category["cat_name"]}</option>";
		}
		?>
	</select>
</div>

<div class="form-group">
	<label for="post_title">Title:</label>
	<input type="text" class="form-control" id="post_title" name="post_title">
</div>

<div class="form-group">
	<label for="post_image">Image:</label>
	<input type="file" class="form-control-file" id="post_image" name="post_image">
</div>

<div class="form-group">
	<label for="post_content">Have at it!</label>
	<textarea class="form-control" id="post_content" name="post_content" rows="15" style="max-width:1500px;"></textarea>
</div>

<div class="form-group">
	<label for="post_tags">Tags:</label>
	<input type="text" class="form-control" id="post_tags" name="post_tags">
</div>

<div class="form-group">
	<label for="post_status">Private or Public:</label>
	<select class="form-control" id="post_status" name="post_status">
		<option value="private">Private</option>
		<option value="public">Public</option>
	</select>
	<small id="statusHelp" class="form-text text-muted">Private means visible only to you through the admin panel.</small>
</div>

<div class="form-group">
	<label for="post_comment_status">Post comments:</label>
	<select class="form-control" id="post_comment_status" name="post_comment_status">
		<option value="disabled" selected>Disabled</option>
		<option value="enabled">Enabled</option>
	</select>
</div>

<button class="btn btn-default" type="submit" name="addPost" value="addPost">Create post</button>

</form>
</div>
<!---nice--->
<script type="text/javascript" src="admin-includes/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/admin-edit.js"></script>
