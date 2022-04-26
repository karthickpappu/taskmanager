<?php
/*
 * All database connection variables
 */

define('DB_USER',"root"); // db user
define('DB_PASSWORD',"nedbs123"); // db password (mention your db password here)
define('DB_DATABASE',"istem"); // database name
define('DB_DATABASE2',""); // database name
define('DB_SERVER',"localhost"); // db server

function escapeSingleQuotes($string){
	//escapse single quotes
	$singQuotePattern = "'";
	$singQuoteReplace = "''";
	return(stripslashes(str_replace($singQuotePattern, $singQuoteReplace, $string)));
}
?>
