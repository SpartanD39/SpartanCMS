<!doctype html>
<html lang="en">
	<head>
		 <!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body>

		<nav class="navbar navbar-dark bg-dark">
			<a class="navbar-brand" style="color: #fff;">SpartanCMS Installer</a>
		</nav>

		<div class="container-fluid">

<?php
if(isset($_GET["removeInstaller"]) && $_GET["removeInstaller"] == "true") {
	header("Location: /index.php");
	$installFile = __FILE__;
	$installDir = dirname(__FILE__);
	unlink($installFile);
	rmdir($installDir);
}
if(isset($_POST["doInstaller"])) {
<<<<<<< HEAD

=======
		
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
	function clean_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
<<<<<<< HEAD
		return $data;
=======
		return $data;	
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
	}
	$DB_USER = clean_input($_POST["dbUser"]);
	$DB_PASS = clean_input($_POST["dbPass"]);
	$DB_NAME = clean_input($_POST["dbName"]);
	$DB_HOST = clean_input($_POST["dbHost"]);
<<<<<<< HEAD

=======
	
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
	$user_name = clean_input($_POST["user_name"]);
	$user_email = clean_input($_POST["user_email"]);
	$user_pass = password_hash(clean_input($_POST["user_password"]),PASSWORD_DEFAULT);
	$user_date_reg = date('y-m-d H:i');
	$user_avatar = "profile_placeholder300x300.png";
	$user_role = "super-admin";
	$user_reg_status = "active";
<<<<<<< HEAD

	$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

	$_CREATE_TABLES_SQL =<<<EOSQL
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
=======
	
	$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

	$_CREATE_TABLES_SQL =<<<EOSQL

SET time_zone = "+00:00";

>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_name` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_author` varchar(255) COLLATE utf8_bin NOT NULL,
  `comment_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `comment_author_ip` varchar(32) COLLATE utf8_bin NOT NULL,
  `comment_content` tinytext COLLATE utf8_bin NOT NULL,
  `comment_status` varchar(32) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(64) COLLATE utf8_bin NOT NULL,
  `post_author_id` int(99) NOT NULL,
  `post_date` datetime(6) NOT NULL,
  `post_image` varchar(256) COLLATE utf8_bin NOT NULL,
  `post_content` mediumtext COLLATE utf8_bin NOT NULL,
  `post_comment_count` int(3) NOT NULL,
  `post_tags` varchar(256) COLLATE utf8_bin NOT NULL,
  `post_status` varchar(32) COLLATE utf8_bin NOT NULL,
  `post_comment_status` varchar(16) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `site_meta`
--

CREATE TABLE `site_meta` (
  `site_opt_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `site_opt_value` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_pass` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_date_reg` date NOT NULL,
  `user_avatar` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_tagline` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_bio` varchar(512) COLLATE utf8_bin NOT NULL,
  `user_role` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_reg_status` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

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

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT;
<<<<<<< HEAD
COMMIT;
=======
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae

EOSQL;

/*
$_CREATE_TABLES_SQL = 'START TRANSACTION';
$_CREATE_TABLES_SQL = 'CREATE TABLE categories (`cat_id` INT(3) NOT NULL,`cat_name` VARCHAR(128) NOT NULL) ENGINE=MyISAM;';
$_CREATE_TABLES_SQL .= 'CREATE TABLE comments (`comment_id` INT(3) NOT NULL,`comment_post_id` INT(3) NOT NULL,`comment_date` DATETIME NOT NULL,`comment_author` VARCHAR(255) NOT NULL,`comment_email` VARCHAR(255)  NOT NULL,`comment_content` tinytext NOT NULL,`comment_status` VARCHAR(32) NOT NULL) ENGINE=MyISAM;';
$_CREATE_TABLES_SQL .= 'CREATE TABLE posts (`post_id` INT(3) NOT NULL,`post_cat_id` INT(3) NOT NULL,`post_title` VARCHAR(64) NOT NULL,  `post_author` VARCHAR(64) NOT NULL,`post_date` DATETIME(6) NOT NULL,`post_image` VARCHAR(256) NOT NULL,`post_content` mediumtext NOT NULL,`post_comment_count` INT(3) NOT NULL,`post_tags` VARCHAR(256) NOT NULL,`post_status` VARCHAR(32) NOT NULL,`post_comment_status` VARCHAR(16) NOT NULL) ENGINE=MyISAM;';
$_CREATE_TABLES_SQL .= 'ALTER TABLE categories ADD PRIMARY KEY (`cat_id`);';
$_CREATE_TABLES_SQL .= 'ALTER TABLE comments ADD PRIMARY KEY (`comment_id`);';
$_CREATE_TABLES_SQL .= 'ALTER TABLE posts ADD PRIMARY KEY (`post_id`);';
$_CREATE_TABLES_SQL .= 'ALTER TABLE categories MODIFY `cat_id` INT(3) NOT NULL AUTO_INCREMENT;';
$_CREATE_TABLES_SQL .= 'ALTER TABLE comments MODIFY `comment_id` INT(3) NOT NULL AUTO_INCREMENT;';
$_CREATE_TABLES_SQL .= 'ALTER TABLE posts MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT;';
$_CREATE_TABLES_SQL .= 'COMMIT;';
*/
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($conn->multi_query($_CREATE_TABLES_SQL) === TRUE) {
	$conn->close();
	$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
<<<<<<< HEAD

	$_CREATE_USER_SQL = "INSERT INTO users (user_name, user_email, user_pass, user_date_reg, user_avatar, user_role, user_reg_status) VALUES ('{$user_name}','{$user_email}','{$user_pass}','{$user_date_reg}','{$user_avatar}','{$user_role}','{$user_reg_status}')";

=======
	
	$_CREATE_USER_SQL = "INSERT INTO users (user_name, user_email, user_pass, user_date_reg, user_avatar, user_role, user_reg_status) VALUES ('{$user_name}','{$user_email}','{$user_pass}','{$user_date_reg}','{$user_avatar}','{$user_role}','{$user_reg_status}')";
	
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
	if($conn->query($_CREATE_USER_SQL) === TRUE) {
		echo<<<EOH
		<br/>
		<div class="row">
<<<<<<< HEAD

			<div class="col-md-3">

			</div>

=======
			
			<div class="col-md-3">
			
			</div>
			
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
			<div class="col-md-6">
				<div class="alert alert-success" role="alert">
					Tables and config file set up successfully! <a href="/installer/installer.php?removeInstaller=true">Click here to delete the installer and go to your homepage.</a>
				</div>
			</div>
<<<<<<< HEAD

			<div class="col-md-3">

			</div>

		</div>

=======
			
			<div class="col-md-3">
			
			</div>
			
		</div>
	
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
EOH;

	$cfgFile = fopen("../includes/db-config.php", "w");
	$cfgEntry =<<<EOF
<?php
define("DB_USER","{$DB_USER}");
define("DB_PASS","{$DB_PASS}");
define("DB_NAME","{$DB_NAME}");
define("DB_HOST","${DB_HOST}");
?>
EOF;
	fwrite($cfgFile, $cfgEntry);
	fclose($cfgFile);
<<<<<<< HEAD

=======
	
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
	} else {
		echo "Error creating user: " . $conn->error;
		echo<<<EOH
		<div class="row">
<<<<<<< HEAD

			<div class="col-md-3">

			</div>

=======
			
			<div class="col-md-3">
			
			</div>
			
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
			<div class="col-md-6">
				<div class="alert alert-danger" role="alert">
					Table setup failed:
				</div>
				<div class="alert alert-danger" role="alert">
					{$conn->error}
				</div>
				<div class="alert alert-danger" role="alert">
					Please report this issue to the dev!.
				</div>
			</div>
<<<<<<< HEAD

			<div class="col-md-3">

			</div>

		</div>

=======
			
			<div class="col-md-3">
			
			</div>
			
		</div>
	
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
EOH;
	}


} else {
    echo "Error creating table: " . $conn->error;
	echo<<<EOH
	<div class="row">

		<div class="col-md-3">

		</div>

		<div class="col-md-6">
			<div class="alert alert-danger" role="alert">
				Table setup failed:
			</div>
			<div class="alert alert-danger" role="alert">
				{$conn->error}
			</div>
			<div class="alert alert-danger" role="alert">
				<a href="/installer/installer.php">Click here after you fix the issue,</a> and retry the installer.
			</div>
		</div>

		<div class="col-md-3">

		</div>

	</div>

EOH;
}

} else {
?>

			<br/>

			<div class="row" id="instructions">

				<div class="col-md-3">

				</div>

				<div class="col-md-6">
					<p>Welcome to the SpartanCMS installer!</p>
					<p>The install process is fairly simple, but you'll need to do a bit of prep.</p>
					<p>You'll need to create a database for the system to use to store posts and such. Do so if you haven't already, and mark down the following information:</p>
					<ul class="list-group list-group-flush">
						<li class="list-group-item list-group-item-info">Database name</li>
						<li class="list-group-item list-group-item-info">Database username</li>
						<li class="list-group-item list-group-item-info">Database password</li>
						<li class="list-group-item list-group-item-info">Database host</li>
					</ul>

					<p>If you need help locating this information or creating a database, consult your database documentation or reach out to your host.</p>
				</div>

				<div class="col-md-3">

				</div>

			</div>

			<div class="row" id="installercheck">

				<br/>

				<div class="col-md-3">

				</div>

				<div class="col-md-6">
					<hr/>
					<h3>Extension Check</h3>
					<p>Below we check if we have the required extensions for this application to run.</p>
					<p>If anything is missing, check your php extensions with a <a href="/installer/phpinfo.php" target="_blank">phpinfo page</a>, and contact your host if you're running into problems getting certain extensions loaded.</p>
<<<<<<< HEAD

=======
					
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
					<?php

						$loaded_exts = get_loaded_extensions();
						echo "<ul class=\"list-group list-group-flush\">";
						$goodMods = [];
						if(in_array("session", $loaded_exts)) {
							echo <<<EOH
							<li class="list-group-item list-group-item-success">'session' extension loaded.</li>
EOH;
							array_push($goodMods,"1");
						} else {
							echo <<<EOH
							<li class="list-group-item list-group-item-danger">'session' extension not loaded!</li>
EOH;
							array_push($goodMods, "0");
						}

						if(in_array("mysqli", $loaded_exts)) {
							echo <<<EOH
							<li class="list-group-item list-group-item-success">'mysqli' extension loaded.</li>
EOH;
							array_push($goodMods, "1");
						} else {
							echo <<<EOH
							<li class="list-group-item list-group-item-danger">'mysqli' extension not loaded!</li>
EOH;
							array_push($goodMods, "0");
						}

						if(in_array("mysqlnd", $loaded_exts)) {
							echo <<<EOH
							<li class="list-group-item list-group-item-success">'mysqlnd' extension loaded.</li>
EOH;
							array_push($goodMods, "1");
						} else {
							echo <<<EOH
							<li class="list-group-item list-group-item-danger">'mysqlnd' extension not loaded!</li>
EOH;
							array_push($goodMods, "0");
						}
<<<<<<< HEAD

=======
						
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
						if(in_array("gd", $loaded_exts)) {
							echo <<<EOH
							<li class="list-group-item list-group-item-success">'gd' extension loaded.</li>
EOH;
							array_push($goodMods, "1");
						} else {
							echo <<<EOH
							<li class="list-group-item list-group-item-danger">'gd' extension not loaded!</li>
EOH;
							array_push($goodMods, "0");
						}
<<<<<<< HEAD

=======
						
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
						echo "</ul>";
					?>

				</div>

				<div class="col-md-3">

				</div>

			</div>

			<div class="row" id="installer">
				<br/>

				<div class="col-md-3">

				</div>

				<div class="col-md-6">

					<hr/>
					<h3>Installer</h3>
					<?php if(!in_array("0", $goodMods)) {?>
					<p>Fill in the below form to set up your database and initial admin user to get going.</p>
					<form class="form" action="" method="POST" id="installerForm">
<<<<<<< HEAD

=======
						
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
							<div class="form-group">

								<label for="dbHost">Database Host</label>
								<input type="text" class="form-control" id="dbHost" name="dbHost" aria-describedby="dbHost-help" placeholder="localhost" required>
								<small id="dbHost-help" class="form-text text-muted">Where your database lives, usually localhost.</small>

							</div>

							<div class="form-group">

								<label for="dbUser">Database user</label>
								<input type="text" class="form-control" id="dbUser" name="dbUser" aria-describedby="dbUser-help" placeholder="userna5_dbuser" required>
								<small id="dbUser-help" class="form-text text-muted">Your database username to login to MySQL.</small>

							</div>

							<div class="form-group">

								<label for="dbName">Database name</label>
								<input type="text" class="form-control" id="dbName" name="dbName" aria-describedby="emailHelp" placeholder="userna5_dbmame" required>
								<small id="emailHelp" class="form-text text-muted">Name of your database.</small>

							</div>

							<div class="form-group">

								<label for="dbPass">Database user password</label>
								<input type="password" class="form-control" id="dbPass" name="dbPass" aria-describedby="dbPass-help" required>
								<small id="dbPass-help" class="form-text text-muted">Database user password.</small>

							</div>

							<div class="form-group">

								<label for="user_name">Admin Username</label>
								<input type="text" class="form-control" id="user_name" name="user_name" aria-describedby="user_name-help" required>
								<small id="user_name-help" class="form-text text-muted">Your name</small>

							</div>

							<div class="form-group">

								<label for="user_email">Admin Email</label>
								<input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="user_email-help" required>
								<small id="user_email-help" class="form-text text-muted">Your email address</small>

							</div>

							<div class="form-group">

								<label for="user_password">Your password</label>
								<input type="password" class="form-control" id="user_password" name="user_password" aria-describedby="user_password-help" required>
								<small id="user_password-help" class="form-text text-muted">Your password</small>

							</div>

							<div class="form-group">

								<label for="user_password_confirm">Confirm your password</label>
								<input type="password" class="form-control" id="user_password_confirm" name="user_password_confirm" aria-describedby="user_password_confirm-help" required>
								<small id="user_password_confirm-help" class="form-text text-muted">Just to make sure...</small>

							</div>
<<<<<<< HEAD

=======
							
							<div class="form-group">
							
								<label for="user_name">Admin Username</label>
								<input type="text" class="form-control" id="user_name" name="user_name" aria-describedby="user_name-help" required>
								<small id="user_name-help" class="form-text text-muted">Your name</small>
							
							</div>
							
							<div class="form-group">
							
								<label for="user_email">Admin Email</label>
								<input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="user_email-help" required>
								<small id="user_email-help" class="form-text text-muted">Your email address</small>
							
							</div>
							
							<div class="form-group">
							
								<label for="user_password">Your password</label>
								<input type="password" class="form-control" id="user_password" name="user_password" aria-describedby="user_password-help" required>
								<small id="user_password-help" class="form-text text-muted">Your password</small>
							
							</div>
							
							<div class="form-group">
							
								<label for="user_password_confirm">Confirm your password</label>
								<input type="password" class="form-control" id="user_password_confirm" name="user_password_confirm" aria-describedby="user_password_confirm-help" required>
								<small id="user_password_confirm-help" class="form-text text-muted">Just to make sure...</small>
							
							</div>
							
>>>>>>> c7935abd7ebaca7d17f0b8979ffb8ae3b76e81ae
							<button type="submit" class="btn btn-dark" id="doInstaller" name="doInstaller">Submit</button>

						</form>
				<?php	} else { ?>

						<p>You need to enable all of the required extensions to install!</p>

				<?php } ?>
				</div>

				<div class="col-md-3">

				</div>

			</div>
<?php

} // end else block for POST statement.
?>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; SpartanCMS</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

		</div>




		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity=	"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="installer-js.js"></script>
	</body>

</html>
