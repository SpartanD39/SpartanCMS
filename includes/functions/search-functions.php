<?php
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
		$conn->close();
	}
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
?>