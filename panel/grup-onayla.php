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
   header("Location: gruplarim.php");
   die("Buraya erişme yetkin yok!");
}
$id=$_POST['id'];
$query = $db->update('gruplar')
            ->where('id', $id)
			->set(array(
			'onay' => '1',
			));
   
if ( $query ){
  header("Location: /onay-bekleyen-gruplarim");
}else {
	echo "Yorum onaylanamadı bir hata oluştu.";
}
?>