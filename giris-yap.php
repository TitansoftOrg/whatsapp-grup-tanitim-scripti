<?php
require_once "panel/BasicDB.php";
require_once "panel/baglan.php";
$sitebilgi = $db->select('site')
					->run(TRUE);
session_start();
ob_start();
include "lang.php";
ob_start();
if(@$_SESSION["giris"] == true){
	header("Location: /ana-sayfa");
    die("Burada olmaman gerekirdi!");
}
$kullanici = @$_SESSION['id'];
$kullanicia = @$_SESSION['kullaniciadi'];
$bilgicek = $db->select('uyeler')
			->where('id', $kullanici)
			->or_where('kullaniciadi', $kullanicia)
			->run(TRUE);
			require_once "panel/fonksiyon.php";
?>

<html>
<head> 
		<title><?=$dil['girisyap']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['girisyap']?></div>
 <div class="panel-body">
 <?php 

//Giriş yap

if($_POST){
	
	$hacker = sha1(base64_encode(md5(base64_encode($_POST["sifre"])))); 
	$kullaniciadi=$_POST["kullaniciadi"];
	$sifre=@substr($hacker, 5, 32);
	
	$cek = $db->prepare("SELECT * FROM uyeler WHERE kullaniciadi=? AND sifre=?");
	$cek->Execute(array($kullaniciadi,$sifre));
	$girisyap = $cek->fetch();
	
	if($girisyap){
		$_SESSION["giris"] = "true";
		$_SESSION["id"] = $girisyap["id"];
		header("Location: /ana-sayfa");

	}else {
		echo '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['hataligiris'].'</div>';
	}
}
?>
<div class="col-md-8 col-md-offset-2">
 <form action="" method="post">
				<div class="form-group">
                    <input name="kullaniciadi" type="text" class="form-control" id="kullaniciadi" placeholder="<?=$dil['kullaniciadi']?>"></div>
                    <div class="form-group"><input name="sifre" class="form-control" type="password" id="sifre" placeholder="<?=$dil['sifre']?>">
					</div>
					<div class="col-md-6"><button class="btn btn-default btn-block login" name="girisyap" type="submit"><?=$dil['girisyap']?></button></div>
                </form>
				
				<div class="col-md-6">
				<a href="/kayit-ol"><button class="btn btn-default btn-block login"><?=$dil['kayitol']?></button></a></div></div>
    <div class="col-md-8 col-md-offset-2"><br /><a href="/sifremi-unuttum"><button class="btn btn-default btn-block login"><?=$dil['sifremiunuttum']?></button></a></div></div>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>