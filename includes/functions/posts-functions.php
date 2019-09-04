<?php
/**
 * Post-related function definitions
 */

/**
* Gets all posts from the database with conditionals.
*
* @param bool $onlypublic Defaults to false. Determines if returns all posts for use or not, false for all posts.
*
* @return array
*/
function get_all_posts(bool $onlypublic = false) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($onlypublic) {
		$sql = "SELECT posts.*, categories.cat_name, users.user_name AS post_author FROM posts INNER JOIN categories ON posts.post_cat_id=categories.cat_id INNER JOIN users ON posts.post_author_id=users.user_id WHERE post_status='public';";
	} else {
		$sql = "SELECT posts.*, categories.cat_name, users.user_name AS post_author FROM posts INNER JOIN categories ON posts.post_cat_id=categories.cat_id INNER JOIN users ON posts.post_author_id=users.user_id";
	}
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		$retArray = $result->fetch_all(MYSQLI_ASSOC);
	} else {
		$retArray = [];
	}
	$conn->close();
	return $retArray;
}

/**
* Displays posts on the front page.
*
* Uses get_all_posts() to get all public posts and output them.
*
* @return void
*/
function display_posts_front() {
	$posts = get_all_posts(true);
	echo<<<EOT
	<h1 class="page-header">
		All Posts
		<small>Hey there stranger!</small>
    </h1>
EOT;
	if(empty($posts)) {
		echo "<p>No posts yet...</p>";
	} else {

		forEach ($posts as $post) {
			$post["post_date"] = date('d-m-y H:i',strtotime($post["post_date"]));
			echo "<h2>";
			echo "<a href=\"index.php?id={$post["post_id"]}&view=post\">{$post["post_title"]}</a>";
			echo "</h2>";

			echo "<p class=\"lead\">";
			echo "by <a href=\"index.php\">{$post["post_author"]}</a>";
			echo "</p>";

			echo "<p><span class=\"glyphicon glyphicon-time\"></span> Posted on {$post["post_date"]}</p>";

			echo "<hr>";
			echo "<img class=\"img-responsive\" src=\"uploads/images/{$post["post_image"]}\" style=\"max-height: 300px; max-width: 900px;\" alt=\"\">";
			echo "<hr>";

			echo "<p>";
			echo htmlspecialchars_decode(substr($post["post_content"], 0, 256)) . "...";
			echo "</p>";

			echo "<a class=\"btn btn-primary\" href=\"index.php?id={$post["post_id"]}&view=post\">Read More <span class=\"glyphicon glyphicon-chevron-right\"></span></a>";

			echo "<hr>";
		}

	}
}


/**
* Retrieves a single post from the database.
*
* @param int $post_id ID of the post we want to get.
*
* @return array
*/
function get_single_post($post_id) {
    $retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$post_id = clean_input($post_id);
	$post_id = $conn->real_escape_string($post_id);
	$sql = "SELECT posts.*, categories.cat_name, users.user_name AS post_author FROM posts INNER JOIN categories ON posts.post_cat_id=categories.cat_id INNER JOIN users ON posts.post_author_id=users.user_id WHERE post_id={$post_id} LIMIT 1;";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		$retArray = $result->fetch_all(MYSQLI_ASSOC);
	} else {
		$retArray = [];
	}
	$conn->close();
	return $retArray;
}

/**
* Collects posts by category from the db.
*
* Takes a category ID as input and returns an array of arrays containing posts in that category.
*
* @param int $cat_id
*
* @return array
*/
function get_posts_by_cat($cat_id) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$cat_id = clean_input($cat_id);
	$cat_id = $conn->real_escape_string($cat_id);
	$sql = "SELECT * FROM posts WHERE post_cat_id={$cat_id} AND post_status='public';";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		$retArray = $result->fetch_all(MYSQLI_ASSOC);
	} else {
		$retArray = [];
	}
	$conn->close();
	return $retArray;
}

/**
* Displays posts in a category
*
* Display function for get_posts_by_cat(), outputs the appropriate HTML for viewing.
*
* @param array $posts Array of arrays containing posts information.
*
* @return void
*/
function display_cat_posts($posts) {
	foreach($posts as $post) {
		$post["post_date"] = date('d-m-y H:i',strtotime($post["post_date"]));
		$post["post_content"] = htmlspecialchars_decode(substr($post["post_content"], 0, 128)) . "...";
		echo<<<EOT
			<h2>
				<a href="index.php?id={$post["post_id"]}&view=post">{$post["post_title"]}</a>
			</h2>

			<p class="lead">
				by <a href="index.php">{$post["post_author"]}</a>
			</p>

			<p><span class="glyphicon glyphicon-time"></span> Posted on {$post["post_date"]}</p>

			<p>{$post["post_content"]}</p>

			<a class="btn btn-primary" href="index.php?id={$post["post_id"]}&view=post">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
			<hr/>
EOT;
	}
}

/**
* Displays a single post
*
* Generates the appropriate HTML for our post to be displayed and redirects on trying to view a private post.
*
* @param int $post_id ID of the post we want to display
*
* @return void
*/
function display_single_post($post_id) {
	$post = get_single_post($post_id);
	forEach($post as $post_data) {
		if($post_data["post_status"] == "private") {
			header("Location: /index.php");
		}
		$post_data["post_date"] = date('d-m-y H:i',strtotime($post_data["post_date"]));
		$post_data["post_content"] = htmlspecialchars_decode($post_data["post_content"]);
		echo<<<EOT
                <!-- Blog Post -->

                <!-- Title -->
                <h1>{$post_data["post_title"]}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{$post_data["post_author"]}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {$post_data["post_date"]}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive img-thumbnail" src="uploads/images/{$post_data["post_image"]}" alt="">

                <hr>

                <!-- Post Content -->
                <div id="post_content">
					{$post_data["post_content"]}
				</div>

                <hr>
EOT;
		if($post_data["post_comment_status"] == "enabled") {
			include("includes/post-comment.php");
		} else {
			echo<<<EOT
			<div class="well">
				<span id="submitstatus"></span>
				<h4>Comments are disabled for this post</h4>
			</div>

EOT;
		}
	}
}

/**
* Creates a new post in the database
*
* Creates a post in the database based on data submitted via a form in the admin posts creation page.
*
* @param array $post_complete Array of new post information.
*
* @return array
*/
function create_post($post_complete) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	//Clean up and create our internal variables to insert.
  $post_cat_id = $conn->real_escape_string(clean_input($post_complete["post_cat_id"]));
	$post_title = $conn->real_escape_string(clean_input($post_complete["post_title"]));
	$post_author_id = $conn->real_escape_string(clean_input($post_complete["post_author_id"]));
	$post_date = $conn->real_escape_string(clean_input($post_complete["post_date"]));
	$post_image = $conn->real_escape_string(clean_input($post_complete["post_image"]));
	$post_content = $conn->real_escape_string(clean_input($post_complete["post_content"]));
	$post_comment_count = $conn->real_escape_string(clean_input($post_complete["post_comment_count"]));
	$post_tags = $conn->real_escape_string(clean_input($post_complete["post_tags"]));
	$post_status = $conn->real_escape_string(clean_input($post_complete["post_status"]));
	$post_comment_status = $conn->real_escape_string(clean_input($post_complete["post_comment_status"]));

	$sql = "INSERT INTO posts (post_cat_id, post_title, post_author_id, post_date, post_image, post_content, post_comment_count, post_tags, post_status, post_comment_status) VALUES ('{$post_cat_id}','{$post_title}','{$post_author_id}','{$post_date}','{$post_image}','{$post_content}','{$post_comment_count}','{$post_tags}','{$post_status}','{$post_comment_status}');";
	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "<div class=\"alert alert-success alert-dismissible show\" role=\"alert\">Post " . $post_title . " Created!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Error!" . $conn->error . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	}
	$conn->close();
	return $retArray;
}

/**
* Updates a post in the database.
*
* Updates a post in the database with information from the editing page form in admin. Contains some in-built error handling.
*
* @param array $post_complete Array of post information retrieved from the database previously.
*
* @return array
*/
function edit_post($post_complete) {
    $retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	//Clean up and create our internal variables to insert.
	$post_id = $conn->real_escape_string(clean_input($post_complete["post_id"]));
  $post_cat_id = $conn->real_escape_string(clean_input($post_complete["post_cat_id"]));
	$post_title = $conn->real_escape_string(clean_input($post_complete["post_title"]));
	$post_author_id = $conn->real_escape_string(clean_input($post_complete["post_author_id"]));
	$post_date = $conn->real_escape_string(clean_input($post_complete["post_date"]));
	$post_image = $conn->real_escape_string(clean_input($post_complete["post_image"]));
	$post_content = $conn->real_escape_string(clean_input($post_complete["post_content"]));
	$post_comment_status = $conn->real_escape_string(clean_input($post_complete["post_comment_status"]));
	$post_tags = $conn->real_escape_string(clean_input($post_complete["post_tags"]));
	$post_status = $conn->real_escape_string(clean_input($post_complete["post_status"]));

	$sql = "UPDATE posts SET post_cat_id='{$post_cat_id}',post_title='{$post_title}',post_author_id='{$post_author_id}',post_date='{$post_date}',post_content='{$post_content}',post_tags='{$post_tags}',post_status='{$post_status}', post_comment_status='{$post_comment_status}'";

	if(!empty($post_image)) {
		$sql .= ",post_image='{$post_image}'";
	}

	$sql .= "WHERE post_id={$post_id};";

	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "<div class=\"alert alert-success alert-dismissible show\" role=\"alert\">Post '" . $post_title . "' Updated!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Error!" . $conn->error . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	}
	$conn->close();
	return $retArray;
}

/**
* Removes a post from the database
*
* Deletes a post from the database based on post id. TODO: Add checks for admin access once user system is implemented.
*
* @param int $post_id Post id of what we want to remove.
*
* @return array
*/
function delete_post($post_id) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	//Clean up and create our internal variables to insert.
	$post_id = $conn->real_escape_string(clean_input($post_id));
    $sql = "DELETE FROM posts WHERE post_id = {$post_id}";
	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "<div class=\"alert alert-success alert-dismissible show\" role=\"alert\">Post Removed! <a href=\"admin-post.php\">Click here</a> to go back to posts.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Error!" . $conn->error . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	}
	$conn->close();
	return $retArray;
}
?>
