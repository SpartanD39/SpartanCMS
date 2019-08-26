<?php

if(isset($_POST["doInstaller"])) {

function clean_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;	
}

$DB_USER = clean_input($_POST["dbUser"]);
$DB_PASS = clean_input($_POST["dbPass"]);
$DB_NAME = clean_input($_POST["dbName"]);
$DB_HOST = clean_input($_POST["dbHost"]);
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
$_CREATE_TABLES_SQL =<<<EOS

START TRANSACTION;

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_author` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment_content` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment_status` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(64) NOT NULL,
  `post_author` varchar(64) NOT NULL,
  `post_date` datetime(6) NOT NULL,
  `post_image` varchar(256) NOT NULL,
  `post_content` mediumtext NOT NULL,
  `post_comment_count` int(3) NOT NULL,
  `post_tags` varchar(256) NOT NULL,
  `post_status` varchar(32) NOT NULL,
  `post_comment_status` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT;
COMMIT;

EOS;
	
}

?>
<!doctype html>
<html lang="en">
	<head>
		 <!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	
	<body>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity=	"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
	
</html>
