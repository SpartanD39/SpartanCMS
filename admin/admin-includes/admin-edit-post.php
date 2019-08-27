<div class="col-lg-11">

<?php 
//TODO - Pull post from DB here and display below.
if(isset($_GET['id'])) {
	$post_id = $_GET['id'];
	$post = get_single_post($post_id);
} else {
	$post[0]["post_id"] = "";
	$post[0]["post_author"] = "";
	$post[0]["post_cat_id"] = "";
	$post[0]["post_title"] = "";
	$post[0]["post_image"] = "";
	$post[0]["post_content"] = "";
	$post[0]["post_tags"] = "";
	$post[0]["post_status"] = "";
	$post[0]["post_comment_status"] = "";
	$post[0]["cat_name"] = "";
}

if(isset($_POST["editPost"])) {
	$post_complete = [];
	$post_complete["post_id"] = $_POST["post_id"];
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
	
	$post_task = edit_post($post_complete);
	$post = get_single_post($post_id);
	if($post_task["status"] == 1) {
		echo $post_task["message"];
	} else {
		echo $post_task["message"];
	}
}
//TODO - Update post on submission.

?>

<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
	<label for="post_author">Author:</label>
	<input type="text" class="form-control" id="post_author" name="post_author" value="<?php echo $post[0]["post_author"];?>">
</div>

<div class="form-group">
	<select class="form-control" id="post_cat_id" name="post_cat_id" value="<?php echo $post[0]["post_cat_id"];?>">
		<?php
		$categories = get_categories();
		foreach($categories as $category) {
			echo "<option value=\"{$category["cat_id"]}\"";
			if($post[0]["post_cat_id"] == $category["cat_id"]) {
				echo "selected";
			}
			echo ">{$category["cat_name"]}</option>";
		}
		?>
	</select>
</div>

<div class="form-group">
	<label for="post_title">Title:</label>
	<input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post[0]["post_title"];?>">
</div>

<div class="form-group">
	<label for="post_image">Image:</label>
	<input type="file" class="form-control-file" id="post_image" name="post_image" value="<?php echo $post[0]["post_image"];?>">
</div>

<div class="form-group">
	<label for="post_content">Have at it!</label>
	<textarea class="form-control" id="post_content" name="post_content" rows="15" style="max-width:1500px;">
	<?php echo $post[0]["post_content"];?>
	</textarea>
</div>

<div class="form-group">
	<label for="post_tags">Tags:</label>
	<input type="text" class="form-control" id="post_tags" name="post_tags" value="<?php echo $post[0]["post_tags"];?>">
</div>

<div class="form-group">
	<label for="post_status">Private or Public:</label>
	<select class="form-control" id="post_status" name="post_status" selected="<?php echo $post[0]["post_status"];?>">
		<option value="private" <?php if($post[0]["post_status"] == "private") {echo "selected";}?> >Private</option>
		<option value="public" <?php if($post[0]["post_status"] == "public") {echo "selected";}?>>Public</option>
	</select>
	<small id="statusHelp" class="form-text text-muted">Private means visible only to you through the admin panel.</small>
</div>

<div class="form-group">
	<label for="post_comment_status">Post comments:</label>
	<select class="form-control" id="post_comment_status" name="post_comment_status">
		<option value="disabled" <?php if($post[0]["post_comment_status"] == "disabled") {echo "selected";}?> >Disabled</option>
		<option value="enabled" <?php if($post[0]["post_comment_status"] == "enabled") {echo "selected";}?>>Enabled</option>
	</select>
</div>

<input type="hidden" id="post_id" name="post_id" value="<?php echo $post[0]["post_id"]; ?>">

<button class="btn btn-default" type="submit" name="editPost" value="editPost">Update post</button>

</form>
</div>
<!---nice--->