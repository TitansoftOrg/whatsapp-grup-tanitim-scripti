<?php
 
session_start();
 
# bilgiyi alalim
$dil=$_GET["dil"];
 
# dil dosyasi varsa;
if( file_exists("dil/".$dil.".php") ){
  #oturuma kaydediyoruz
  $_SESSION["dil"]=$dil;
}
 
# anasayfaya yonleniyoruz.
print '<script>location="index.php";</script>';
exit;
 
?>