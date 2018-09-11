<?php
require_once "panel/BasicDB.php";
require_once "panel/baglan.php";
$sitebilgi = $db->select('site')
					->run(TRUE);
session_Start();
include "lang.php";
require_once "panel/fonksiyon.php";
$kullanici = @$_SESSION['id'];
$kullanicia = @$_SESSION['kullaniciadi'];
$bilgicek = $db->select('uyeler')
			->where('id', $kullanici)
			->or_where('kullaniciadi', $kullanicia)
			->run(TRUE);
?>
<html>
<head> 
		<title><?php echo $grupgor['isim'];?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?php echo $grupgor['isim'];?></div>
 <div class="panel-body">
<h1><center><?php echo $grupgor['isim'];?></center></h1>
<hr>
<?php
$sahip = $db->select('uyeler')
->where('id', $grupgor['sahibi'])
->run(TRUE);
?>
<?php
$kategoriduzelt = $db->select('kategoriler')
->where('idsi', $grupgor['kategori'])
->run(TRUE);
?>
<?php
	if ($grupgor['kategori'] == $kategoriduzelt['idsi']) {
		$kategoriad = $kategoriduzelt['kategoriadi'];  
	}
	?>
<?php
	if ($grupgor['sahibi'] == $sahip['id']) {
		$sahipad = $sahip['ad']; 
		$sahipsoyad = $sahip['soyad']; 
	}
	?>
<h5><center><?=$dil['grupsahibi']?>: <?php echo $sahipad;?> <?php echo $sahipsoyad;?> | <?=$dil['uyesayisi']?>: <?php echo $grupgor['uyesayisi'];?>/256 | <?=$dil['kategori']?>: <?php echo $kategoriad; ?></center></h5>
<?php echo $grupgor['aciklama'];?>
<center><a class="btn btn-primary" href="https://chat.whatsapp.com/<?php echo $grupgor['link'] ?>" target="_blank"><i class="fa fa-chevron-right"></i> <?=$dil['grubakatil']?></a></button></center>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>