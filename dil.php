<?php
session_start();
$dil	=strip_tags($_GET["dil"]);
if ($dil =="tr" || $dil == "en" || $dil == "ru" || $dil == "ar" || $dil == "az" || $dil == "cn" || $dil == "de" || $dil == "es" || $dil == "fr" || $dil == "por"){
	$_SESSION["dil"] = $dil;
	 header("location: ".$_SERVER['HTTP_REFERER']."");
}else {
	 header("location: /index.php");
}
 
?>