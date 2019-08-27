<div class="col-lg-11">
<?php 
$post = get_single_post($post_id);

if(isset($_POST["confirmDelete"])) {
	$post_task = delete_post($_POST["post_id"]);
	
	if($post_task["status"] == 1) {
		echo $post_task["message"];
	} else {
		echo $post_task["message"];
	}
} else {
	echo<<<EOT
<form action="" method="POST">
	<div class="form-group">
		<label for="delete_confirm">Are you sure you want to delete "{$post[0]["post_title"]}"?</label>
		<input type="hidden" id="post_id" name="post_id" value="{$post[0]["post_id"]}">
	</div>
	<button class="btn btn-default" type="submit" name="confirmDelete" value="confirmDelete">Delete Post</button>
	<br/>
	<br/>
	<p><a href="admin-post.php">Click here</a> to return to the posts list.
</form>	
EOT;
}
?>

</div>
