<?php
require_once "panel/BasicDB.php";
require_once "panel/baglan.php";
session_start();
$secili = $_SESSION['dil'];
session_destroy();
session_start();
$_SESSION['dil'] = $secili;
require ("dil/".$_SESSION["dil"].".php");
header('location: /index.php');
?>