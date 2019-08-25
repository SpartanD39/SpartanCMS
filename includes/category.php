<?php
if(isset($_GET["id"]) && $_GET["view"] == "category") {
	$posts = get_posts_by_cat($_GET["id"]);
	
	if(empty($posts)) {
		echo "<p>Nothing posted in this category yet...<p/>";
	} else {
		display_cat_posts($posts);
	}
	
}
?>