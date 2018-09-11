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
   header("Location: /kategoriler");
   die("Buraya erişme yetkin yok!");
}
$id=$_POST['idsi'];
$query = $db->delete('kategoriler')
            ->where('idsi', $id)
            ->done();
   
if ( $query ){
  header("Location: /kategoriler");
}else {
	echo "Kategori silinemedi bir hata oluştu.";
}
?>