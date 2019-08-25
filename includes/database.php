<?php
include("db-config.php");

function clean_input($data) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$conn->real_escape_string($data);
	return $data;	
}

/*Categories-related functions.*/
function get_categories() {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT * FROM categories;";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$retArray[] = $row;
		}
	} else {
		$retArray = [];
	}
	$conn->close();
	return $retArray;
}

function get_category($cat_id) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$cat_id = clean_input($cat_id);
	$cat_id = $conn->real_escape_string($cat_id);
	$sql = "SELECT * FROM categories where cat_id={$cat_id}";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$retArray["cat_id"] = $row["cat_id"];
			$retArray["cat_name"] = $row["cat_name"];
		}
	} else {
		$retArray = [];
	}
	$conn->close();
	return $retArray;
}

function add_category($cat_name) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$cat_name = clean_input($cat_name);
	$cat_name = $conn->real_escape_string($cat_name);
	$sql = "INSERT INTO categories (cat_id, cat_name) VALUES (NULL, '".$cat_name."');";
	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "Successfully added new category.";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "Error with query: " . $sql . "<br/>" . $conn->error;
	}
	$conn->close();
	return $retArray;
}

function delete_category($cat_id) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$cat_id = clean_input($cat_id);
	$cat_id = $conn->real_escape_string($cat_id);
	$sql = "DELETE FROM categories WHERE cat_id = '".$cat_id."'";
	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "Successfully removed category.";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "Error with query: " . $sql . "<br/>" . $conn->error;
	}
	$conn->close();
	return $retArray;
}

function update_category($cat_id, $newname) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$cat_id = clean_input($cat_id);
	$cat_id = $conn->real_escape_string($cat_id);
	$newname = clean_input($newname);
	$newname = $conn->real_escape_string($newname);
	$sql = "UPDATE categories SET cat_name='{$newname}' WHERE cat_id={$cat_id}";
	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "Successfully updated category.";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "Error with query: " . $sql . "<br/>" . $conn->error;
	}
	$conn->close();
	return $retArray;
}

function display_admin_categories($categories) {
	if(empty($categories)) {
		echo <<<EOT
			<tr>
				<td>0</td>
				<td>None</td>
				<td><a href="/admin/admin-categories.php">Delete</a></td>
				<td><a href="/admin/admin-categories.php">Update</a></td>
			</tr>
EOT;
	} else {
		forEach ($categories as $category) {
			echo <<<EOT
				<tr>
					<td>{$category["cat_id"]}</td>
					<td>{$category["cat_name"]}</td>
					<td><a class="confirmdelete" href="/admin/admin-categories.php?delete={$category["cat_id"]}">Delete</a></td>
					<td><a href="/admin/admin-categories.php?update={$category["cat_id"]}">Update</a></td>
				</tr>
EOT;
		}
	}
}

/*Search-related functions*/
function doSearch($searchterm) {
	$retArray = [];
	if(empty($searchterm)) {
		$retArray["FAILED"] = 1;
	} else {
		$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$searchterm = $conn->real_escape_string($searchterm);
		$sql = "SELECT post_title, post_author, post_content, post_date, post_id FROM posts WHERE post_tags LIKE '%$searchterm%' AND post_status='public';";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$retArray[] = $row;
			}
			$retArray["FAILED"] = 0;
		} else {
			$retArray["FAILED"] = 1;
		}
	}
	$conn->close();
	return $retArray;
}

function displaySearch($searchResults) {
	if($searchResults["FAILED"] == 1) {
		echo "<h1>Nothing found!</h1>";
	} else {
		unset($searchResults["FAILED"]);
		forEach ($searchResults as $result) {
				echo "<h2>";
				echo "<a href=\"#\">{$result["post_title"]}</a>";
				echo "</h2>";
					
				echo "<p class=\"lead\">";
				echo "by <a href=\"index.php\">{$result["post_author"]}</a>";
				echo "</p>";
					
				echo "<p><span class=\"glyphicon glyphicon-time\"></span> Posted on {$result["post_date"]}</p>";
					
				echo "<a class=\"btn btn-primary\" href=\"#\">Read More <span class=\"glyphicon glyphicon-chevron-right\"></span></a>";
				echo "<hr/>";
		}
	}
}

/*Post related functions*/
function get_all_posts(bool $onlypublic = false) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($onlypublic) {
		$sql = "SELECT * FROM posts WHERE post_status='public';";
	} else {
		$sql = "SELECT posts.*, categories.cat_name FROM posts INNER JOIN categories ON posts.post_cat_id=categories.cat_id ";
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

function display_posts_front() {
	$posts = get_all_posts(true);
	echo<<<EOT
	<h1 class="page-header">
		Page Heading
		<small>Secondary Text</small>
    </h1>
EOT;
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
		echo "<img class=\"img-responsive\" src=\"uploads/images/{$post["post_image"]}\" width=\"250\" alt=\"\">";
		echo "<hr>";
		
		echo "<p>";
		echo htmlspecialchars_decode(substr($post["post_content"], 0, 256)) . "...";
		echo "</p>";
		
		echo "<a class=\"btn btn-primary\" href=\"index.php?id={$post["post_id"]}&view=post\">Read More <span class=\"glyphicon glyphicon-chevron-right\"></span></a>";
		
		echo "<hr>";
	}
}

function get_single_post($post_id) {
    $retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$post_id = clean_input($post_id);
	$post_id = $conn->real_escape_string($post_id);
	$sql = "SELECT posts.*, categories.cat_name FROM posts RIGHT JOIN categories ON posts.post_cat_id=categories.cat_id WHERE post_id={$post_id} LIMIT 1;";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		$retArray = $result->fetch_all(MYSQLI_ASSOC);
	} else {
		$retArray = [];
	}
	$conn->close();
	return $retArray;
}

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

function display_single_post($post_id) {
	$post = get_single_post($post_id);
	forEach($post as $post_data) {
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

function create_post($post_complete) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	//Clean up and create our internal variables to insert.	
    $post_cat_id = $conn->real_escape_string(clean_input($post_complete["post_cat_id"]));
	$post_title = $conn->real_escape_string(clean_input($post_complete["post_title"]));
	$post_author = $conn->real_escape_string(clean_input($post_complete["post_author"]));
	$post_date = $conn->real_escape_string(clean_input($post_complete["post_date"]));
	$post_image = $conn->real_escape_string(clean_input($post_complete["post_image"]));
	$post_content = $conn->real_escape_string(clean_input($post_complete["post_content"]));
	$post_comment_count = $conn->real_escape_string(clean_input($post_complete["post_comment_count"]));
	$post_tags = $conn->real_escape_string(clean_input($post_complete["post_tags"]));
	$post_status = $conn->real_escape_string(clean_input($post_complete["post_status"]));
	$post_comment_status = $conn->real_escape_string(clean_input($post_complete["post_comment_status"]));
	
	$sql = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_image, post_content, post_comment_count, post_tags, post_status, post_comment_status) VALUES ('{$post_cat_id}','{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_comment_count}','{$post_tags}','{$post_status}','{$post_comment_status}');";
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

function edit_post($post_complete) {
    $retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	//Clean up and create our internal variables to insert.
	$post_id = $conn->real_escape_string(clean_input($post_complete["post_id"]));	
    $post_cat_id = $conn->real_escape_string(clean_input($post_complete["post_cat_id"]));
	$post_title = $conn->real_escape_string(clean_input($post_complete["post_title"]));
	$post_author = $conn->real_escape_string(clean_input($post_complete["post_author"]));
	$post_date = $conn->real_escape_string(clean_input($post_complete["post_date"]));
	$post_image = $conn->real_escape_string(clean_input($post_complete["post_image"]));
	$post_content = $conn->real_escape_string(clean_input($post_complete["post_content"]));
	$post_comment_count = $conn->real_escape_string(clean_input($post_complete["post_comment_count"]));
	$post_tags = $conn->real_escape_string(clean_input($post_complete["post_tags"]));
	$post_status = $conn->real_escape_string(clean_input($post_complete["post_status"]));
	
	$sql = "UPDATE posts SET post_cat_id='{$post_cat_id}',post_title='{$post_title}',post_author='{$post_author}',post_date='{$post_date}',post_content='{$post_content}',post_tags='{$post_tags}',post_status='{$post_status}', post_comment_status='{$post_comment_status}'";
	
	if(!empty($post_image)) {
		$sql .= ",post_image='{$post_image}'";
	}
	
	$sql .= "WHERE post_id={$post_id};";
	
	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "<div class=\"alert alert-success alert-dismissible show\" role=\"alert\">Post " . $post_title . " Updated!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Error!" . $conn->error . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	}
	$conn->close();
	return $retArray;	
}

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

// Comment Functions
function get_post_comments($post_id) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$post_id = clean_input($post_id);
	$post_id = $conn->real_escape_string($post_id);
	$sql = "SELECT * from comments where comment_post_id={$post_id} AND comment_status='approved';";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		$retArray = $result->fetch_all(MYSQLI_ASSOC);
	} else {
		$retArray = [];
	}
	$conn->close();
	return $retArray;
}

function display_post_comments($comments) {
	foreach($comments as $comment) {
		$comment["comment_date"] = date('d-m-y H:i',strtotime($comment["comment_date"]));
		echo<<<EOT
<div class="media">
	<a class="pull-left" href="#">
		<img class="media-object" src="http://placehold.it/64x64" alt="">
	</a>
	<div class="media-body">
		<h4 class="media-heading">{$comment["comment_author"]}
			<small>{$comment["comment_date"]}</small>
		</h4>
		{$comment["comment_content"]}
	</div>
</div>

EOT;
	}
}

function add_post_comment($commentdata) {
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$retArray = [];
	$comment = [];
	parse_str($commentdata, $comment);
	$comment["post_id"] = clean_input($comment["post_id"]);
	$comment["date"] = date('d-m-y H:i');
	$comment["comment_author"] = clean_input($comment["comment_author"]);
	$comment["comment_email"] = clean_input($comment["comment_email"]);
	$comment["comment_content"] = clean_input($comment["comment_content"]);
	$comment["status"] = "pending";
	$sql = "INSERT INTO comments (comment_post_id, comment_date, comment_author, comment_email, comment_content, comment_status) VALUES ('{$comment["post_id"]}','{$comment["date"]}','{$comment["comment_author"]}','{$comment["comment_email"]}','{$comment["comment_content"]}','{$comment["status"]}')";
	
	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "<div class=\"alert alert-success alert-dismissible show\" role=\"alert\">Comment submitted!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Error!" . $conn->error . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	}
	$conn->close();
	return $retArray;
	
	
}

function admin_delete_post_comment($commentid) {
	
}
?>
