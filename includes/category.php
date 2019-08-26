<?php
if(isset($_GET["id"]) && $_GET["view"] == "category") {
	$posts = get_posts_by_cat($_GET["id"]);
	
	echo "<h1 class=\"page-header\">";
		echo "Category Posts ";
		echo "<small>Let's see...</small>";
    echo "</h1>";
	
	if(empty($posts)) {
		echo "<p>Nothing posted in this category yet...<p/>";
	} else {
		display_cat_posts($posts);
	}
	
}
?>