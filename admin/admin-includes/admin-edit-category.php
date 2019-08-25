<?php 
	$selected_post = get_category($_GET["update"]);
	echo<<<EOT
	<form action="admin-categories.php" method="POST" class="form">
		<div class="form-group">
			<label for="updatecategory">Update Category:</label>
			<input type="text" name="updatecategory" class="form-control" value="{$selected_post["cat_name"]}">
			<input type="hidden" name="cat_id" value="{$selected_post["cat_id"]}">
		</div>
		<button name="updatesubmit" value="submit" class="btn btn-default" type="submit">
			<span class="glyphicon glyphicon-import"></span> Update Category
		</button>
	</form>
	<br/>
EOT;

?>