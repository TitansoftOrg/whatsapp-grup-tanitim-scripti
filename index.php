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
if(mobile){
document.location="/m";
}</script>
		<title><?=$dil['anasayfa']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
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
					->limit(0, 4)
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
									<a class="btn btn-default btn-sm" href="/<?php echo $row['id'] ?>/<?php echo seo($row['isim']); ?>"><i class="fa fa-info"></i> <?=$dil['grupdetaylari']?></a></button>
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
<?php if($slidersay > 4) { ?>
			  <div class="item">
                    <ul class="thumbnails">
					<?php
					$random1 = $db->select("gruplar")
					->where('onay', '1')
					->where('grupdili', $secilen)
					->orderby('', 'rand()')
					->limit(4, 4)
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
<?php } ?>
<?php if($slidersay > 8) { ?>
			  <div class="item">
                    <ul class="thumbnails">
					<?php
					$random2 = $db->select("gruplar")
					->where('onay', '1')
					->where('grupdili', $secilen)
					->orderby('', 'rand()')
					->limit(8, 4)
					->run();
					?>
					<?php foreach ($random2 as $row) {
						
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
<?php } ?>
        </div>
        
       <?php if($slidersay > 4) { ?>
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
	->orderby('id', 'desc')
	->limit(0, 3)
	->where('grupdili', $secilen)
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
	
//Şimdi for döngüsüne gidiyoruz
?>
<?php @$ilkkategori = $row['kategori'] ?>
<?php if($row['kategori'] != @$sonkategori) { ?>
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
					<?php if($row['kategori'] != @$sonkategori) {
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
	->limit(3, 3)
	->run();
	?>

<?php if ($say > 3) { ?>
		<div class="item">
                    <ul class="thumbnails">
					<?php if ($row['kategori'] != $sonkategori) {
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
<?php } ?>
		</div>
  </div>
  
<?php $sonkategori = $row['kategori']; ?>

<?php if ($say > 3) { ?>

<nav>
			<ul class="control-box pager">
			<li><a class="" href="/kategori/<?php echo $katurl; ?>"><i class="fa fa-plus-square"></i> <?php echo $kategoriyaz; ?></font><?=$dil['gruplari']?></a></button></li>
				<li><a data-slide="prev" href="#<?php echo $row['kategori'] ?>" class=""><i class="glyphicon glyphicon-chevron-left"></i> <?=$dil['onceki']?></a></li>
				<li><a data-slide="next" href="#<?php echo $row['kategori'] ?>" class=""><?=$dil['sonraki']?> <i class="glyphicon glyphicon-chevron-right"></i></a></li>
			</ul>
</nav> <?php } ?>
	   <!-- /.control-box -->   
         </div>
</div>    
<?php if(!empty($reklambilgi["anasayfaust"])) { ?>
<?php if ($i %2 ) { ?>
		 
		 <div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['sponsoralani']?></div>
 <div class="panel-body"><?php echo $reklambilgi["anasayfaust"]; ?></div></div>
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