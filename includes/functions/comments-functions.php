<?php
// Comment Functions
function admin_get_comments() {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT comments.*, posts.post_title FROM comments LEFT JOIN posts ON comments.comment_post_id=posts.post_id ORDER BY comments.comment_id DESC";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		$retArray = $result->fetch_all(MYSQLI_ASSOC);
	} else {
		$retArray = [];
	}
	$conn->close();
	return $retArray;
}

function admin_change_comment_status($comment_id, $comment_status){
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$comment_id = clean_input($comment_id);
	if($comment_status == "pending") {
		$new_comment_status = "approved";
	} elseif($comment_status == "approved") {
		$new_comment_status = "pending";
	} else {
		die("Nice try!");
	}

	$sql = "UPDATE comments SET comment_status='{$new_comment_status}' WHERE comment_id={$comment_id}";
	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = "1";
		$retArray["message"] ="<div class=\"alert alert-warning\" role=\"alert\">Comment status changed.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
	} else {
		$retArray["status"] = "0";
		$retArray["message"] = "<div class=\"alert alert-danger\" role=\"alert\">Error changing comment status!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
	}

	$conn->close();
	return $retArray;
}

function admin_delete_comment($comment_id) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$comment_id = clean_input($comment_id);
	$sql = "DELETE from comments where comment_id = {$comment_id}";
	$result = $conn->query($sql);
	if($result === TRUE) {
		$retArray["status"] = "1";
		$retArray["message"] ="<div class=\"alert alert-warning\" role=\"alert\">Comment deleted.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
	} else {
		$retArray["status"] = "0";
		$retArray["message"] = "<div class=\"alert alert-danger\" role=\"alert\">Error deleting comment!<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>";
	}

	$conn->close();
	return $retArray;
}

function admin_display_comments() {
	$commentsAll = admin_get_comments();
	if(empty($commentsAll)) {
		echo<<<EOB
		<tr>
			<td>0</td>
			<td>Nothing</td>
			<td>to</td>
			<td>display</td>
			<td>yet.</td>
			<td>Sorry</td>
			<td>homeslice.</td>
			<td>None</td>
		</tr>
EOB;

	} else {

		foreach($commentsAll as $comment) {
			if($comment["post_title"] == "") {
				$comment["post_title"] = "Orphaned";
				$comment["comment_post_id"] = "#";
			}
		echo<<<EOB
		<tr>
			<td><a href="/index.php?id={$comment["comment_post_id"]}&view=post" target="_blank">{$comment["post_title"]}</a></td>
			<td>{$comment["comment_date"]}</td>
			<td>{$comment["comment_author"]}</td>
			<td>{$comment["comment_email"]}</td>
			<td>{$comment["comment_author_ip"]}</td>
			<td>{$comment["comment_content"]}</td>
			<td>{$comment["comment_status"]}</td>
			<td><a href="/admin/admin-comments.php?action=status&commentID={$comment["comment_id"]}&commentStatus={$comment["comment_status"]}" class="confirmstatus">Change Status</a></td>
			<td><a href="/admin/admin-comments.php?action=delete&commentID={$comment["comment_id"]}" class="confirmcommentdelete">Delete Comment</a></td>
		</tr>
EOB;

	}

	}
}

function get_post_comments($post_id) {
	$retArray = [];
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$post_id = clean_input($post_id);
	$post_id = $conn->real_escape_string($post_id);
	$sql = "SELECT * from comments where comment_post_id={$post_id} AND comment_status='approved' ORDER BY comment_id DESC;";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		$retArray = $result->fetch_all(MYSQLI_ASSOC);
	} else {
		$retArray = [];
	}
	$conn->close();
	return $retArray;
}

function display_post_comments($post_id) {
	$comments = get_post_comments($post_id);
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
	$comment["date"] = date('y-m-d H:i');
	$comment["comment_author"] = clean_input($comment["comment_author"]);
	$comment["comment_email"] = clean_input($comment["comment_email"]);
	$comment["comment_author_ip"] = clean_input(get_client_ip());
	$comment["comment_content"] = clean_input($comment["comment_content"]);
	$comment["status"] = "pending";

	$stmt = $conn->prepare("INSERT INTO comments (comment_post_id, comment_date, comment_author, comment_email, comment_author_ip, comment_content,comment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("issssss", $comment["post_id"], $comment["date"], $comment["comment_author"], $comment["comment_email"], $comment["comment_author_ip"], $comment["comment_content"], $comment["status"] );

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

function generate_captcha() {

  function generate_string($input, $strength = 5) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
      $random_character = $input[mt_rand(0, $input_length - 1)];
      $random_string .= $random_character;
    }
    return $random_string;
  }

  $image = imagecreatetruecolor(200, 50);

  imageantialias($image, true);

  $colors = [];

  $red = rand(125, 175);
  $green = rand(125, 175);
  $blue = rand(125, 175);

  for($i = 0; $i < 5; $i++) {
    $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
  }

  imagefill($image, 0, 0, $colors[0]);

  for($i = 0; $i < 10; $i++) {
    imagesetthickness($image, rand(2, 10));
    $rect_color = $colors[rand(1, 4)];
    imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
  }

  $black = imagecolorallocate($image, 0, 0, 0);
  $white = imagecolorallocate($image, 255, 255, 255);
  $textcolors = [$black, $white];

  $fonts = '../../fonts/UbuntuMono-R.ttf';

  $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $string_length = 6;
  $captcha_string = generate_string($permitted_chars, $string_length);

  for($i = 0; $i < $string_length; $i++) {
    $letter_space = 170/$string_length;
    $initial = 15;

    imagettftext($image, 20, rand(-15, 15), $initial + $i*$letter_space, rand(20, 40), $textcolors[rand(0, 1)], $fonts, $captcha_string[$i]);
  }

  header('Content-type: image/png');
  imagepng($image);
  imagedestroy($image);
  return $captcha_string;
}
?>
