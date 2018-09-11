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
		<title><?=$dil['tumwhatsappgruplari']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['tumwhatsappgruplari']?></div>
 <div class="panel-body">
 <?php if ($grup) { 
          foreach ( $grup as $row ) { ?>
		  <?php 
		  $grupsahibi = $db->select('uyeler')
					->where('id', $row['sahibi'])
					->run(TRUE);
		  if ($row['kategori'] == $row['idsi']) {
					if($_SESSION['dil'] == "tr") {
$katdilyaz = $row['kategoritr']; } else if($_SESSION['dil'] == "en") {
$katdilyaz = $row['kategorien']; } else if($_SESSION['dil'] == "de") {
$katdilyaz = $row['kategoride']; } else if($_SESSION['dil'] == "fr") {
$katdilyaz = $row['kategorifr']; } else if($_SESSION['dil'] == "ru") {
$katdilyaz = $row['kategoriru']; } else if($_SESSION['dil'] == "cn") {
$katdilyaz = $row['kategoricn']; } else if($_SESSION['dil'] == "es") {
$katdilyaz = $row['kategories']; } else if($_SESSION['dil'] == "az") {
$katdilyaz = $row['kategoriaz']; } else if($_SESSION['dil'] == "ar") {
$katdilyaz = $row['kategoriar']; } else if($_SESSION['dil'] == "pt") {
$katdilyaz = $row['kategoript']; }
$seourl = $row['seokategori'];
						}

					if ($row['sahibi'] == $grupsahibi['id']) {
					$sahipad = $grupsahibi['ad']; 
					$sahipsoyad = $grupsahibi['soyad']; 
						} ?>
		  <li class="col-sm-4">
							<div class="fff">
								<div class="thumbnail">
									<a href="/<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><img src="https://chat.whatsapp.com/invite/icon/<?php echo $row['link'] ?>" alt=""></a>
									<div class="caption">
									<h4><a href="/<?php echo $row['id']; ?>/<?php echo seo($row['isim']); ?>"><font color="#444"><?php echo $row['isim']; ?></font></a></h4>
									<p><i class="fa fa-user"></i> <?php echo $sahipad; ?> <?php echo $sahipsoyad; ?></p>
									<p><a href="/kategori/<?php echo $seourl; ?>"><font color="#999"><i class="fa fa-tag"></i> <?php echo $katdilyaz; ?></font></a></p>
									<p><i class="fa fa-group"></i> <?php echo $row['uyesayisi']; ?>/256</p>
									<a class="btn btn-default btn-sm" href="/<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><i class="fa fa-info"></i> <?=$dil['grupdetaylari']?></a></button>
									<hr>
									<a class="btn btn-primary btn-sm" href="https://chat.whatsapp.com/<?php echo $row['link'] ?>" target="_blank"><i class="fa fa-chevron-right"></i> <?=$dil['grubakatil']?></a></button>
								</div>
								</div>
                            </div>
                        </li>
						<div class="clearfix visible-xs"></div>
 <?php } } ?>
  <?php if ($satir_sayisi > $sayfa_limiti ) { ?>
 <div class="col-md-12 col-offset-2">
<ul class="pagination">
						<?php $a = ceil($satir_sayisi/$sayfa_limiti);
echo '<ul class="pagination">';
for($b = 1 ; $b <= $a ; $b++){
echo '<li><a href="/gruplar/'. $b . ' ">' . $b . '</a></li>';
}echo '</ul>';	
				?>
					</ul>
  </div><?php } ?>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>