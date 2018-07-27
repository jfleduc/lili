<?php
/**
  * Attempt to make a connection to the database. 
  * 
  * If there is an error making a connection, we will catch
  * the error and write a message to the Apache SSL error log file. 
  *
  * If the connection is successful, PHP will close it automatically
  * when the script ends.
  */
try {
	$dbconn = new PDO("mysql:" . 
                          "host=" . DBHOST . ";" . 
                          "dbname=" . DBNAME . ";" ,
	                   DBUSER,
	                   DBPASS);
}
catch(PDOException $exception) {
	$logdata = $exception->getCode() . ' ' . $exception->getMessage();
	error_log ($logdata);
	die ('Please contact an administrator.');
}
/**
  * Configure PDO so that it throws exceptions on errors
  */
$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
