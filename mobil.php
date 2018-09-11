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
<script type="text/javascript">
var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()))
if(!mobile){
document.location="/ana-sayfa";
}</script>
		<title><?=$dil['anasayfa']?> | <?php echo $sitebilgi["baslik"];?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Wpgrup.com Whatsapp grubunuzun tanıtımını yaparak daha geniş bir kitleye sahip olmanıza veya kafanıza göre bir whatsapp grubu bularak hoş sohbetlerin döndüğü bir ortama katılmanız için hazırlanmış ücretsiz bir servistir. Gün geçtikçe büyüyen sitemizde<?=$dil['gruplari']?>nızı ücretsiz bir şekilde ekleyerek hemen tanıtımınızı yapmanıza olanak sağlıyoruz.">
		<meta name="keywords" content="Whatsapp<?=$dil['gruplari']?>, WP<?=$dil['gruplari']?>, <?php foreach ($kategoriler as $row) { ?>Whatsapp <?php echo $row['kategoriadi'];?><?=$dil['gruplari']?>, <?php } ?>">
		<meta name="author" content="Enes Alperen Hürüm">
		<script src="/source/js/jquery.js"></script>
		<link rel="stylesheet" href="/source/css/theme.min.css">
		<link rel="stylesheet" href="/source/css/theme.mobile.css">
		<script src="/source/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="/source/css/slider.css">
		<script src="/source/js/slider.js"></script>
		<link href="/source/awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="/source/css/fonts.css" rel="stylesheet">
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-10 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['rastgelesecilengruplar']?></div>
<div class="panel-body">
 <div class="carousel slide" id="myCarousel">
        <div class="carousel-inner">
            <div class="item active">
                    <ul class="thumbnails">
					<?php
					$random = $db->select("gruplar")
					->where('onay', '1')
					->where('grupdili', $secilen)
					->orderby('', 'rand()')
					->limit(0, 1)
					->run();
					?>
					<?php foreach ($random as $row) {
						
					$kategoriadi = $db->select('kategoriler')
										->where('idsi', $row['kategori'])
										->run(TRUE);
					$grupsahibi = $db->select('uyeler')
										->where('id', $row['sahibi'])
										->run(TRUE);

					if ($row['kategori'] == $kategoriadi['idsi']) {
										 		if($_SESSION['dil'] == "tr") {
$katdil = $kategoriadi['kategoritr']; } else if($_SESSION['dil'] == "en") {
$katdil = $kategoriadi['kategorien']; } else if($_SESSION['dil'] == "de") {
$katdil = $kategoriadi['kategoride']; } else if($_SESSION['dil'] == "fr") {
$katdil = $kategoriadi['kategorifr']; } else if($_SESSION['dil'] == "ru") {
$katdil = $kategoriadi['kategoriru']; } else if($_SESSION['dil'] == "cn") {
$katdil = $kategoriadi['kategoricn']; } else if($_SESSION['dil'] == "es") {
$katdil = $kategoriadi['kategories']; } else if($_SESSION['dil'] == "az") {
$katdil = $kategoriadi['kategoriaz']; } else if($_SESSION['dil'] == "ar") {
$katdil = $kategoriadi['kategoriar']; } else if($_SESSION['dil'] == "pt") {
$katdil = $kategoriadi['kategoript']; }
					$kategoriyaz = $katdil; 
					$katurl = $kategoriadi['seokategori'];
						}
					if ($row['sahibi'] == $grupsahibi['id']) {
					$sahipad = $grupsahibi['ad']; 
					$sahipsoyad = $grupsahibi['soyad']; 
						}
						?>
                        <li class="col-sm-3">
							<div class="fff">
								<div class="thumbnail">
									<a href="/<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><img src="https://chat.whatsapp.com/invite/icon/<?php echo $row['link'] ?>" alt=""></a>
									<div class="caption">
									<h4><a href="/<?php echo $row['id']; ?>/<?php echo seo($row['isim']); ?>"><font color="#444"><?php echo $row['isim']; ?></font></a></h4>
									<p><i class="fa fa-user"></i> <?php echo $sahipad; ?> <?php echo $sahipsoyad; ?></p>
									<p><a href="/kategori/<?php echo $katurl; ?>"><font color="#999"><i class="fa fa-tag"></i> <?php echo $kategoriyaz; ?></font></a></p>
									<p><i class="fa fa-group"></i> <?php echo $row['uyesayisi']; ?>/256</p>
									<a class="btn btn-default btn-sm" href="<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><i class="fa fa-info"></i> <?=$dil['grupdetaylari']?></a></button>
									<hr>
									<a class="btn btn-primary btn-sm" href="https://chat.whatsapp.com/<?php echo $row['link'] ?>" target="_blank"><i class="fa fa-chevron-right"></i> <?=$dil['grubakatil']?></a></button>
								</div>
								</div>
                            </div>
                        </li>
					<?php } ?>
                    </ul>
              </div>
			  <?php 
$slidersayi = $db->prepare("SELECT COUNT(*) FROM gruplar WHERE onay = '1' AND grupdili = '".$secilen."'");
$slidersayi->execute();
$slidersay = $slidersayi->fetchColumn();
?>
			  
					<?php
					$random1 = $db->select("gruplar")
					->where('onay', '1')
					->where('grupdili', $secilen)
					->orderby('', 'rand()')
					->limit(1, 11)
					->run();
					?>
					<?php foreach ($random1 as $row) {
						
					$kategoriadi = $db->select('kategoriler')
										->where('idsi', $row['kategori'])
										->run(TRUE);
					$grupsahibi = $db->select('uyeler')
										->where('id', $row['sahibi'])
										->run(TRUE);

					if ($row['kategori'] == $kategoriadi['idsi']) {
										 		if($_SESSION['dil'] == "tr") {
$katdil = $kategoriadi['kategoritr']; } else if($_SESSION['dil'] == "en") {
$katdil = $kategoriadi['kategorien']; } else if($_SESSION['dil'] == "de") {
$katdil = $kategoriadi['kategoride']; } else if($_SESSION['dil'] == "fr") {
$katdil = $kategoriadi['kategorifr']; } else if($_SESSION['dil'] == "ru") {
$katdil = $kategoriadi['kategoriru']; } else if($_SESSION['dil'] == "cn") {
$katdil = $kategoriadi['kategoricn']; } else if($_SESSION['dil'] == "es") {
$katdil = $kategoriadi['kategories']; } else if($_SESSION['dil'] == "az") {
$katdil = $kategoriadi['kategoriaz']; } else if($_SESSION['dil'] == "ar") {
$katdil = $kategoriadi['kategoriar']; } else if($_SESSION['dil'] == "pt") {
$katdil = $kategoriadi['kategoript']; }
		$kategoriyaz = $katdil;
		$katurl = $kategoriadi['seokategori'];
						}
					if ($row['sahibi'] == $grupsahibi['id']) {
					$sahipad = $grupsahibi['ad']; 
					$sahipsoyad = $grupsahibi['soyad']; 
						}
						?>
						<div class="item">
                    <ul class="thumbnails">
                        <li class="col-sm-3">
							<div class="fff">
								<div class="thumbnail">
									<a href="/<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><img src="https://chat.whatsapp.com/invite/icon/<?php echo $row['link'] ?>" alt=""></a>
									<div class="caption">
									<h4><a href="/<?php echo $row['id']; ?>/<?php echo seo($row['isim']); ?>"><font color="#444"><?php echo $row['isim']; ?></font></a></h4>
									<p><i class="fa fa-user"></i> <?php echo $sahipad; ?> <?php echo $sahipsoyad; ?></p>
									<p><a href="/kategori/<?php echo $katurl; ?>"><font color="#999"><i class="fa fa-tag"></i> <?php echo $kategoriyaz; ?></font></a></p>
									<p><i class="fa fa-group"></i> <?php echo $row['uyesayisi']; ?>/256</p>
									<a class="btn btn-default btn-sm" href="<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><i class="fa fa-info"></i> <?=$dil['grupdetaylari']?></a></button>
									<hr>
									<a class="btn btn-primary btn-sm" href="https://chat.whatsapp.com/<?php echo $row['link'] ?>" target="_blank"><i class="fa fa-chevron-right"></i> <?=$dil['grubakatil']?></a></button>
								</div>
								</div>
                            </div>
                        </li>
                    </ul>
              </div>
<?php } ?>
        </div>
        
       <?php if($slidersay > 1) { ?>
	   <nav>
			<ul class="control-box pager">
				<li><a data-slide="prev" href="#myCarousel" class=""><i class="glyphicon glyphicon-chevron-left"></i></a></li>
				<li><a data-slide="next" href="#myCarousel" class=""><i class="glyphicon glyphicon-chevron-right"></a></i></li>
			</ul>
		</nav>  
	   <?php } ?>		
    </div></div>
  </div>
  </div>
<div class="col-lg-7 col-md-offset-1">
<?php
$kategorii = $db->select("kategoriler")
->run();
foreach($kategorii as $kate){
	
	$kateid = $kate['idsi'];
	$grupcek = $db->select("gruplar")
	->where('onay', '1')
	->where('kategori', $kate['idsi'])
	->where('grupdili', $secilen)
	->orderby('id', 'desc')
	->limit(0, 1)
	->run();
	
	foreach ($grupcek as $row) {
		
	$kategoriadi = $db->select('kategoriler')
	->run(TRUE);

	if ($row['kategori'] == $kate['idsi']) {
						 		if($_SESSION['dil'] == "tr") {
$katdil = $kate['kategoritr']; } else if($_SESSION['dil'] == "en") {
$katdil = $kate['kategorien']; } else if($_SESSION['dil'] == "de") {
$katdil = $kate['kategoride']; } else if($_SESSION['dil'] == "fr") {
$katdil = $kate['kategorifr']; } else if($_SESSION['dil'] == "ru") {
$katdil = $kate['kategoriru']; } else if($_SESSION['dil'] == "cn") {
$katdil = $kate['kategoricn']; } else if($_SESSION['dil'] == "es") {
$katdil = $kate['kategories']; } else if($_SESSION['dil'] == "az") {
$katdil = $kate['kategoriaz']; } else if($_SESSION['dil'] == "ar") {
$katdil = $kate['kategoriar']; } else if($_SESSION['dil'] == "pt") {
$katdil = $kate['kategoript']; }
		$kategoriyaz = $katdil;
	}
?>
<?php $ilkkategori = $row['kategori'] ?>
<?php if ($row['kategori'] != @$sonkategori) { ?>
<div class="panel panel-primary">
<?php 
$kat = $kate['idsi'];
$saydir = $db->prepare("SELECT COUNT(*) FROM gruplar WHERE onay = '1' AND kategori = $kateid AND grupdili = '".$secilen."'");
$saydir->execute();
$say = $saydir->fetchColumn();
?>
 <?php 
$i = @($i + 1);
?>
 <div class="panel-heading"><?php echo $kategoriyaz; ?><?=$dil['gruplari']?></div>
 <div class="panel-body">
<div class="carousel slide" id="<?php echo $row['kategori'] ?>">
        <div class="carousel-inner">
            <div class="item active">
                    <ul class="thumbnails">
					<?php if ($row['kategori'] != @$sonkategori) {
	  foreach ($grupcek as $row) { ?>
	   <?php if ($row['kategori'] == $kate['idsi']) {
						 		if($_SESSION['dil'] == "tr") {
$katdil = $kate['kategoritr']; } else if($_SESSION['dil'] == "en") {
$katdil = $kate['kategorien']; } else if($_SESSION['dil'] == "de") {
$katdil = $kate['kategoride']; } else if($_SESSION['dil'] == "fr") {
$katdil = $kate['kategorifr']; } else if($_SESSION['dil'] == "ru") {
$katdil = $kate['kategoriru']; } else if($_SESSION['dil'] == "cn") {
$katdil = $kate['kategoricn']; } else if($_SESSION['dil'] == "es") {
$katdil = $kate['kategories']; } else if($_SESSION['dil'] == "az") {
$katdil = $kate['kategoriaz']; } else if($_SESSION['dil'] == "ar") {
$katdil = $kate['kategoriar']; } else if($_SESSION['dil'] == "pt") {
$katdil = $kate['kategoript']; }
		$kategoriyaz = $katdil;
		$katurl = $kate['seokategori'];
	}
	$gpshp = $db->select('uyeler')
	->where('id', $row['sahibi'])
	->run(TRUE);
	if ($row['sahibi'] == $gpshp['id']) {
					$sahipadi = $gpshp['ad']; 
					$sahipsoyadi = $gpshp['soyad']; 
						}
	  ?>
	  
					<li class="col-sm-4">
							<div class="fff">
								<div class="thumbnail">
									<a href="/<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><img src="https://chat.whatsapp.com/invite/icon/<?php echo $row['link'] ?>" alt=""></a>
									<div class="caption">
									<h4><a href="/<?php echo $row['id']; ?>/<?php echo seo($row['isim']); ?>"><font color="#444"><?php echo $row['isim']; ?></font></a></h4>
									<p><i class="fa fa-user"></i> <?php echo $sahipadi; ?> <?php echo $sahipsoyadi; ?></p>
									<p><a href="/kategori/<?php echo $katurl; ?>"><font color="#999"><i class="fa fa-tag"></i> <?php echo $kategoriyaz; ?></font></a></p>
									<p><i class="fa fa-group"></i> <?php echo $row['uyesayisi']; ?>/256</p>
									<a class="btn btn-default btn-sm" href="<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><i class="fa fa-info"></i> <?=$dil['grupdetaylari']?></a></button>
									<hr>
									<a class="btn btn-primary btn-sm" href="https://chat.whatsapp.com/<?php echo $row['link'] ?>" target="_blank"><i class="fa fa-chevron-right"></i> <?=$dil['grubakatil']?></a></button>
								</div>
								</div>
                            </div>
                        </li>
						
	  <?php } } ?>
						 </ul>
        </div>
		<?php 
		
		$grupcekk = $db->select("gruplar")
	->where('onay', '1')
	->where('kategori', $kate['idsi'])
	->where('grupdili', $secilen)
	->orderby('id', 'desc')
	->limit(1, 5)
	->run();
	?>

<?php if ($say > 1) { ?>
		
					<?php if ($row['kategori'] != @$sonkategori) {
	  foreach ($grupcekk as $row) { ?>
	   <?php if ($row['kategori'] == $kate['idsi']) {
						 		if($_SESSION['dil'] == "tr") {
$katdil = $kate['kategoritr']; } else if($_SESSION['dil'] == "en") {
$katdil = $kate['kategorien']; } else if($_SESSION['dil'] == "de") {
$katdil = $kate['kategoride']; } else if($_SESSION['dil'] == "fr") {
$katdil = $kate['kategorifr']; } else if($_SESSION['dil'] == "ru") {
$katdil = $kate['kategoriru']; } else if($_SESSION['dil'] == "cn") {
$katdil = $kate['kategoricn']; } else if($_SESSION['dil'] == "es") {
$katdil = $kate['kategories']; } else if($_SESSION['dil'] == "az") {
$katdil = $kate['kategoriaz']; } else if($_SESSION['dil'] == "ar") {
$katdil = $kate['kategoriar']; } else if($_SESSION['dil'] == "pt") {
$katdil = $kate['kategoript']; }
		$kategoriyaz = $katdil;
		$katurl = $kate['seokategori'];
	}
	$gpshp = $db->select('uyeler')
	->where('id', $row['sahibi'])
	->run(TRUE);
	if ($row['sahibi'] == $gpshp['id']) {
					$sahipadi = $gpshp['ad']; 
					$sahipsoyadi = $gpshp['soyad']; 
						}
	  ?>
	  <div class="item">
                    <ul class="thumbnails">
					<li class="col-sm-4">
							<div class="fff">
								<div class="thumbnail">
									<a href="/<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><img src="https://chat.whatsapp.com/invite/icon/<?php echo $row['link'] ?>" alt=""></a>
									<div class="caption">
									<h4><a href="/<?php echo $row['id']; ?>/<?php echo seo($row['isim']); ?>"><font color="#444"><?php echo $row['isim']; ?></font></a></h4>
									<p><i class="fa fa-user"></i> <?php echo $sahipadi; ?> <?php echo $sahipsoyadi; ?></p>
									<p><a href="/kategori/<?php echo $katurl; ?>"><font color="#999"><i class="fa fa-tag"></i> <?php echo $kategoriyaz; ?></font></a></p>
									<p><i class="fa fa-group"></i> <?php echo $row['uyesayisi']; ?>/256</p>
									<a class="btn btn-default btn-sm" href="<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><i class="fa fa-info"></i> <?=$dil['grupdetaylari']?></a></button>
									<hr>
									<a class="btn btn-primary btn-sm" href="https://chat.whatsapp.com/<?php echo $row['link'] ?>" target="_blank"><i class="fa fa-chevron-right"></i> <?=$dil['grubakatil']?></a></button>
								</div>
								</div>
                            </div>
                        </li>
							 </ul>
        </div>
	  <?php } } ?>
					
<?php } ?>
		</div>
  </div>
	  
<?php $sonkategori = $row['kategori'] ?>
<?php if ($say > 1) { ?>

<nav>
			<ul class="control-box pager">
				<li><a data-slide="prev" href="#<?php echo $row['kategori'] ?>" class=""><i class="glyphicon glyphicon-chevron-left"></i> <?=$dil['onceki']?></a></li>
				<li><a data-slide="next" href="#<?php echo $row['kategori'] ?>" class=""><?=$dil['sonraki']?> <i class="glyphicon glyphicon-chevron-right"></i></a></li>
			</ul>
</nav> <hr><nav>
			<ul class="control-box pager">
				<li><a class="" href="/kategori/<?php echo $katurl; ?>"><i class="fa fa-group"></i> <?=$dil['tum']?> <?php echo $kategoriyaz; ?><?=$dil['gruplari']?></a></button></li>
				
			</ul>
</nav><?php } ?>
	   <!-- /.control-box -->   
         </div>
</div>    
<?php if(!empty($reklambilgi["anasayfaalt"])) { ?>
<?php if ($i %2 ) { ?>
		 
		 <div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['sponsoralani']?></div>
 <div class="panel-body"><?php echo $reklambilgi["anasayfaalt"]; ?></div></div>
	<?php } ?>
<?php } ?>
	<?php } ?>
	
	<?php 
// For döngüsünü ve fonksiyonu bitiriyoruz 
} }
?>

</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>