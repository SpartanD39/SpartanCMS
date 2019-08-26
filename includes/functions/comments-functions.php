<?php
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
	$comment["comment_author_ip"] = clean_input(get_client_ip());
	$comment["comment_content"] = clean_input($comment["comment_content"]);
	$comment["status"] = "pending";
	
	$stmt = $conn->prepare("INSERT INTO comments (comment_post_id, comment_date, comment_author, comment_email, comment_author_ip, comment_content,comment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("iisssss", $comment["post_id"], $comment["date"], $comment["comment_author"], $comment["comment_email"], $comment["comment_author_ip"], $comment["comment_content"], $comment["status"] );
	
	//$result = $conn->query($sql);
	if($stmt->execute() === TRUE) {
		$retArray["status"] = 1;
		$retArray["message"] = "<div class=\"alert alert-success alert-dismissible show\" role=\"alert\">Comment submitted!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	} else {
		$retArray["status"] = 0;
		$retArray["message"] = "<div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Error!" . $conn->error . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><div class=\"alert alert-danger alert-dismissible show\" role=\"alert\">Error!" . $sql . "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>  </button> </div><br/>";
	}
	$conn->close();
	return $retArray;
	
	
}

function admin_delete_post_comment($commentid) {
	
}
?>