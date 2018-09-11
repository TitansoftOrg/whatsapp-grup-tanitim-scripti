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
<?php 
$page = @$_GET['page'];
$page_limit = 9;
if($page == '' || $page == 1)
{
	$page1 = 0;
}else{
$page1  = ($page * $page_limit) - $page_limit;
}
						
$kategoriismi = @$_GET['seokategori'];

$kategoricek = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('onay', '1')
				->where('seokategori', $kategoriismi)
				->where('grupdili', $secilen)
				->orderby('id', 'desc')
				->limit($page1, $page_limit)
				->run();
$kategoricekz = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('onay', '1')
				->where('seokategori', $kategoriismi)
				->where('grupdili', $secilen)
				->orderby('id', 'desc')
				->limit($page1, $page_limit)
				->run(TRUE);
				if ($kategoriismi == $kategoricekz["seokategori"]) {
					$ayikla = $kategoricekz["kategori"] ;
					$kateg = $kategoricekz["seokategori"];
				}
				$page_no = $db->query("SELECT * FROM gruplar WHERE onay = '1' AND kategori = $ayikla")->rowCount();
?>
<?php
$kategoriyazdir = $db->select('kategoriler')
->where('seokategori', $kategoriismi)
->run(TRUE);
if($_SESSION['dil'] == "tr") {
$katdil = $kategoriyazdir['kategoritr']; } else if($_SESSION['dil'] == "en") {
$katdil = $kategoriyazdir['kategorien']; } else if($_SESSION['dil'] == "de") {
$katdil = $kategoriyazdir['kategoride']; } else if($_SESSION['dil'] == "fr") {
$katdil = $kategoriyazdir['kategorifr']; } else if($_SESSION['dil'] == "ru") {
$katdil = $kategoriyazdir['kategoriru']; } else if($_SESSION['dil'] == "cn") {
$katdil = $kategoriyazdir['kategoricn']; } else if($_SESSION['dil'] == "es") {
$katdil = $kategoriyazdir['kategories']; } else if($_SESSION['dil'] == "az") {
$katdil = $kategoriyazdir['kategoriaz']; } else if($_SESSION['dil'] == "ar") {
$katdil = $kategoriyazdir['kategoriar']; } else if($_SESSION['dil'] == "pt") {
$katdil = $kategoriyazdir['kategoript']; }
?>

<head> 
		<?php include "pages/head.php"; ?>
		<title><?php echo $katdil;?><?=$dil['gruplari']?> | <?php echo $sitebilgi["baslik"];?></title>
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?php echo $katdil;?><?=$dil['gruplari']?></div>
 <div class="panel-body">
 <?php if ($kategoricek) { 
          foreach ( $kategoricek as $row ) { ?>
		  <?php 
		  $grupsahibi = $db->select('uyeler')
					->where('id', $row['sahibi'])
					->run(TRUE);
		  if ($row['kategori'] == $row['idsi']) {
			  if($_SESSION['dil'] == "tr") {
					$katdil = $row['kategoritr']; } else if($_SESSION['dil'] == "en") {
$katdil = $row['kategorien']; } else if($_SESSION['dil'] == "de") {
$katdil = $row['kategoride']; } else if($_SESSION['dil'] == "fr") {
$katdil = $row['kategorifr']; } else if($_SESSION['dil'] == "ru") {
$katdil = $row['kategoriru']; } else if($_SESSION['dil'] == "cn") {
$katdil = $row['kategoricn']; } else if($_SESSION['dil'] == "es") {
$katdil = $row['kategories']; } else if($_SESSION['dil'] == "az") {
$katdil = $row['kategoriaz']; } else if($_SESSION['dil'] == "ar") {
$katdil = $row['kategoriar']; } else if($_SESSION['dil'] == "pt") {
$katdil = $row['kategoript']; }
$katurl = $row['seokategori'];
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
									<p><a href="/kategori/<?php echo $katurl; ?>"><font color="#999"><i class="fa fa-tag"></i> <?php echo $katdil; ?></font></a></p>
									<p><i class="fa fa-group"></i> <?php echo $row['uyesayisi']; ?>/256</p>
									<a class="btn btn-default btn-sm" href="/<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><i class="fa fa-info"></i> <?=$dil['grupdetaylari']?></a></button>
									<hr>
									<a class="btn btn-primary btn-sm" href="https://chat.whatsapp.com/<?php echo $row['link'] ?>" target="_blank"><i class="fa fa-chevron-right"></i> <?=$dil['grubakatil']?></a></button>
								</div>
								</div>
                            </div>
                        </li>
 <?php } } ?>
 <?php if ($page_no > $page_limit ) { ?>
 <div class="col-md-12 col-offset-2">
<ul class="pagination">
						<?php $a = ceil($page_no/$page_limit);
echo '<ul class="pagination">';
for($b = 1 ; $b <= $a ; $b++){
echo '<li><a href="/kategori/'. $kateg .'/'. $b . ' ">' . $b . '</a></li>';
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