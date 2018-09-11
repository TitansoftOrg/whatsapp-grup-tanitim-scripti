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
			$getcek = @$_GET['id'];
			$getbilgi = $db->select('gruplar')
			->where('id', $getcek)
			->run(TRUE);
 if($bilgiler["yetki"] == '0' and $getbilgi["sahibi"] != $bilgiler["id"]){
				header("Location: /onaylanan-gruplarim");
				die("Buraya erişme yetkin yok!");
				}
$id=$_GET['id'];
$query = $db->delete('gruplar')
            ->where('id', $id)
            ->done();
   
if ( $query ){
  header("Location: /onaylanan-gruplarim");
}else {
	echo "Grup silinemedi bir hata oluştu.";
}
?>

