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
		<title><?=$dil['kategoriekle']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php require_once "panel/fonksiyon.php";
include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['kategoriekle']?></div>
 <div class="panel-body">
 <?php if($bilgiler['yetki'] == 0) {
	 die("Buraya erişme yetkin yok");
 } ?>
 <div class="col-lg-8 col-md-offset-2">
 <form action="kategori-ekle.php" method="post">
					<div class="col-md-12">
					<div class="form-group">
					<label><?=$dil['kategoriadi']?></label>
					<input type="text" class="form-control" placeholder="<?=$dil['kategoriadi']?>" name="kategoriadi">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['arapca']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['arapca']?>)" name="kategoriar">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['cince']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['cince']?>)" name="kategoricn">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['almanca']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['almanca']?>)" name="kategoride">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['ingilizce']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['ingilizce']?>)" name="kategorien">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['ispanyolca']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['ispanyolca']?>)" name="kategories">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['fransizca']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['fransizca']?>)" name="kategorifr">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['azerice']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['azerice']?>)" name="kategoriaz">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['portekizce']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['portekizce']?>)" name="kategoript">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['rusca']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['rusca']?>)" name="kategoriru">
		</div>
		<div class="form-group">
					<label><?=$dil['ceviri']?>(<?=$dil['turkce']?>)</label>
					<input type="text" class="form-control" placeholder="<?=$dil['ceviri']?>(<?=$dil['turkce']?>)" name="kategoritr">
		</div>
	</div> 
	
									 <div class="col-md-12">
										<div class="form-group">
										<label><font color="#FFF">Kaydet</font></label>
											<button type="submit" name="kategoriekle" class="btn btn-primary btn-block"><?=$dil['gonder']?></button>
										</div>
									</div>
</div>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>