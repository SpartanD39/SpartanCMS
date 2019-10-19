<?php
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
	$newname = clean_input($newname);
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
?>
