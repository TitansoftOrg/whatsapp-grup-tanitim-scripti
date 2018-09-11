<?php 
$host = "localhost";
$db_name = "";
$db_user = "";
$db_pass = "";
try {
$db = new Erbilen\Database\BasicDB($host, $db_name, $db_user, $db_pass); 
} catch ( PDOException $e ) {
	print $e->getMessage();
}
?>