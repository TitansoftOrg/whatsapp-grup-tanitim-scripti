<?php
require_once "BasicDB.php";
require_once "baglan.php"; 
session_Start();
if($_SESSION["giris"] == false){
	header("Location: /giris-yap");
    die("Burada olmaman gerekirdi!");
}
$uye_id = $_SESSION['id'];
$bilgiler = $db->select('uyeler')
			->where('id', $uye_id)
			->run(TRUE);
if($bilgiler["yetki"] == 0){
   header("Location: /uyeler");
   die("Buraya erişme yetkin yok!");
}
$id=$_POST['id'];
$query = $db->update('uyeler')
            ->where('id', $id)
			->set(array(
			'yetki' => '1',
			));
   
if ( $query ){
  header("Location: /uyeler");
}else {
	echo "bir hata oluştu.";
}
?>