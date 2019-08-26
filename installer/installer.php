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
//$_CREATE_TABLES_SQL = 'START TRANSACTION';

$_CREATE_TABLES_SQL = 'CREATE TABLE categories (`cat_id` INT(3) NOT NULL,`cat_name` VARCHAR(128) NOT NULL) ENGINE=MyISAM;';

$_CREATE_TABLES_SQL .= 'CREATE TABLE comments (`comment_id` INT(3) NOT NULL,`comment_post_id` INT(3) NOT NULL,`comment_date` DATETIME NOT NULL,`comment_author` VARCHAR(255) NOT NULL,`comment_email` VARCHAR(255)  NOT NULL,`comment_content` tinytext NOT NULL,`comment_status` VARCHAR(32) NOT NULL) ENGINE=MyISAM;';

$_CREATE_TABLES_SQL .= 'CREATE TABLE posts (`post_id` INT(3) NOT NULL,`post_cat_id` INT(3) NOT NULL,`post_title` VARCHAR(64) NOT NULL,  `post_author` VARCHAR(64) NOT NULL,`post_date` DATETIME(6) NOT NULL,`post_image` VARCHAR(256) NOT NULL,`post_content` mediumtext NOT NULL,`post_comment_count` INT(3) NOT NULL,`post_tags` VARCHAR(256) NOT NULL,`post_status` VARCHAR(32) NOT NULL,`post_comment_status` VARCHAR(16) NOT NULL) ENGINE=MyISAM;';

$_CREATE_TABLES_SQL .= 'ALTER TABLE categories ADD PRIMARY KEY (`cat_id`);';

$_CREATE_TABLES_SQL .= 'ALTER TABLE comments ADD PRIMARY KEY (`comment_id`);';

$_CREATE_TABLES_SQL .= 'ALTER TABLE posts ADD PRIMARY KEY (`post_id`);';

$_CREATE_TABLES_SQL .= 'ALTER TABLE categories MODIFY `cat_id` INT(3) NOT NULL AUTO_INCREMENT;';

$_CREATE_TABLES_SQL .= 'ALTER TABLE comments MODIFY `comment_id` INT(3) NOT NULL AUTO_INCREMENT;';

$_CREATE_TABLES_SQL .= 'ALTER TABLE posts MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT;';

//$_CREATE_TABLES_SQL .= 'COMMIT;';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if ($conn->multi_query($_CREATE_TABLES_SQL) === TRUE) {
    echo<<<EOH
	<br/>
	<div class="row">
		
		<div class="col-md-3">
		
		</div>
		
		<div class="col-md-6">
			<div class="alert alert-success" role="alert">
				Tables set up successfully!
			</div>
		</div>
		
		<div class="col-md-3">
		
		</div>
		
	</div>
	
EOH;
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
					<p>You'll need to create a database for the system to use to store posts and such. Do so if you haven't already, and mark downt he following information:</p>
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
					<p>If anything is missing, check your php extensions with a phpinfo page, and contact your host if you're running into problems getting certain extensions loaded.</p>
					
					<?php
						
						$loaded_exts = get_loaded_extensions();
						echo "<ul class=\"list-group list-group-flush\">";
						if(in_array("session", $loaded_exts)) {
							echo <<<EOH
							<li class="list-group-item list-group-item-success">'session' extension loaded.</li>
EOH;
						} else {
							echo <<<EOH
							<li class="list-group-item list-group-item-danger">'session' extension not loaded!</li>
EOH;
						}
						
						if(in_array("mysqli", $loaded_exts)) {
							echo <<<EOH
							<li class="list-group-item list-group-item-success">'mysqli' extension loaded.</li>
EOH;
						} else {
							echo <<<EOH
							<li class="list-group-item list-group-item-danger">'mysqli' extension not loaded!</li>
EOH;
						}
						
						if(in_array("mysqlnd", $loaded_exts)) {
							echo <<<EOH
							<li class="list-group-item list-group-item-success">'mysqlnd' extension loaded.</li>
EOH;
						} else {
							echo <<<EOH
							<li class="list-group-item list-group-item-danger">'mysqlnd' extension not loaded!</li>
EOH;
						}
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
					<p>Fill in the below form to set up your database and get going.</p>
					<form class="form" action="" method="POST">
						
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
							
							<button type="submit" class="btn btn-dark" id="doInstaller" name="doInstaller">Submit</button>
							
						</form>
				
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
	</body>
	
</html>
