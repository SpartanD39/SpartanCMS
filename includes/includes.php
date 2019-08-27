<?php
define("DS", DIRECTORY_SEPARATOR);

define("CONFIG_DIR", dirname(__FILE__) . DS);

define("FRONT_FUNCS_DIR", CONFIG_DIR . "functions" . DS);


if(!file_exists(CONFIG_DIR . "db-config.php")) {
	header("Location: /installer/installer.php");
}

include(CONFIG_DIR . "db-config.php");

include(FRONT_FUNCS_DIR . "functions.php");

include(FRONT_FUNCS_DIR . "posts-functions.php");

include(FRONT_FUNCS_DIR . "category-functions.php");

include(FRONT_FUNCS_DIR . "search-functions.php");

include(FRONT_FUNCS_DIR . "comments-functions.php");

?>
