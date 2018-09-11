<?php
	$lng = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
	if (@!$_SESSION["dil"]) {
		if($lng == "tr" || $lng ==  "en" || $lng ==  "ar" || $lng ==  "es" || $lng ==  "ru" || $lng ==  "az" || $lng ==  "cn" || $lng ==  "de" || $lng ==  "pt" || $lng ==  "fr") {
		$_SESSION["dil"] = $lng; 
		header("Location ".$_SERVER['REQUEST_URI'].""); } 
		else { $_SESSION["dil"] == "en"; }
	}
	require ("dil/".$_SESSION["dil"].".php");
	$secilen = @$_SESSION['dil'];
?>