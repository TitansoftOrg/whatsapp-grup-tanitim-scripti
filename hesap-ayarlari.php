<?php
require_once "panel/BasicDB.php";
require_once "panel/baglan.php";
$sitebilgi = $db->select('site')
					->run(TRUE);
session_Start();
include "lang.php"; 
if($_SESSION["giris"] == false){
	header("Location: /giris-yap");
    die("Burada olmaman gerekirdi!");
}
$kullanici = @$_SESSION['id'];
$kullanicia = @$_SESSION['kullaniciadi'];
$bilgicek = $db->select('uyeler')
			->where('id', $kullanici)
			->or_where('kullaniciadi', $kullanicia)
			->run(TRUE);
?>

<html>
<head>
		<title><?=$dil['hesapayarlari']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php require_once "panel/fonksiyon.php"; include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['hesapayarlari']?></div>
 <div class="panel-body">
 <form action="" method="post">
	<div class="row">
					<div class="col-md-12">
					<?php echo @$hatayazdir; ?>
					<div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['kullaniciadi']?></label>
					<input type="text" class="form-control" value="<?php echo $bilgicek['kullaniciadi']; ?>" name="kullaniciadi" required>
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
					<label><?=$dil['sifre']?></label>
					<input type="password" class="form-control" placeholder="<?=$dil['sifre']?>" name="sifre">
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
					<label><?=$dil['eposta']?></label>
					<input type="email" class="form-control" value="<?php echo $bilgicek['email']; ?>" name="email" required>
		</div>
	</div>
	<?php
	if ($bilgiler['yetki']=="1") {
		$yetkisi = "Admin";
	}else if($bilgiler['yetki']=="0"){
		$yetkisi = "Üye";
	}
	?>
	<div class="col-md-6">
		<div class="form-group">
					<label><?=$dil['isim']?></label>
					<input type="text" class="form-control" value="<?php echo $bilgicek['ad']; ?>" name="ad" required>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
					<label><?=$dil['soyisim']?></label>
					<input type="text" class="form-control" value="<?php echo $bilgicek['soyad']; ?>" name="soyad" required>
		</div>
	</div>
	
									 <div class="col-md-12">
										<div class="form-group">
										<label><font color="#FFF">Kaydet</font></label>
											<button type="submit" name="hesapayarlari" class="btn btn-primary btn-block"><?=$dil['guncelle']?></button>
										</div>
									</div>
</div>
			</form>						
		</div>
		<!-- /.container-fluid -->
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>