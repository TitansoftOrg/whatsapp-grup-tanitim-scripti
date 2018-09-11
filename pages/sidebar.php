<div class="col-lg-3">
<div class="panel panel-primary">

 <div class="panel-heading"><?php if(@$_SESSION['giris'] != true ) { ?><?=$dil['giriskayit']?><?php } ?><?php if(@$_SESSION['giris'] == true ) { ?><?=$dil['hesabim']?><?php } ?></div>
<?php if(@$_SESSION['giris'] == true ) { ?><div class="list-group"><?php } ?><div class="panel-body"><?php if(@$_SESSION['giris'] != true ) { ?>
			
                <form action="/giris-yap" method="post">
				<div class="form-group">
                    <input name="kullaniciadi" type="text" class="form-control" id="kullaniciadi" placeholder="<?=$dil['kullaniciadi']?>"></div>
                    <div class="form-group"><input name="sifre" class="form-control" type="password" id="sifre" placeholder="<?=$dil['sifre']?>">
					</div>
					<div class="col-md-6"><button class="btn btn-default btn-block login" name="girisyap" type="submit"><?=$dil['girisyap']?></button></div>
                </form>
				<div class="col-md-6">
				<a href="/kayit-ol"><button class="btn btn-default btn-block login"><?=$dil['kayitol']?></button></a></div>
<?php } ?>
<?php if(@$_SESSION['giris'] == true ) { ?>
<style type="text/css">
.avatar {
    width: 100px;
    height: 100px;
    margin: 10px auto 30px;
    border-radius: 100%;
    background-size: cover;
}
	.yuvarla{ 
	border-radius: 100px;
    margin: -2px -6px -10px;
	}
	</style>
	<?php 
$uyecik = $_SESSION['id'];
$grupla = $db->prepare("SELECT COUNT(*) FROM gruplar WHERE sahibi = $uyecik AND onay = '1'");
$grupla->execute();
$gruplaa = $grupla->fetchColumn();
?>
<?php 
$onaybekle = $db->prepare("SELECT COUNT(*) FROM gruplar WHERE onay = '0'");
$onaybekle->execute();
$onaybekleyen = $onaybekle->fetchColumn();
?>
<?php 
$onaylan = $db->prepare("SELECT COUNT(*) FROM gruplar WHERE onay = '1'");
$onaylan->execute();
$onaylanan = $onaylan->fetchColumn();
?>
<?php 
$Oonaynekleyengruplarim = $db->prepare("SELECT COUNT(*) FROM gruplar WHERE onay = '0' AND sahibi = $uyecik");
$Oonaynekleyengruplarim->execute();
$Oonaynekleyengruplar = $Oonaynekleyengruplarim->fetchColumn();
?>
<div class="avatar"><img src="/user.png" class="yuvarla" width="100px"></div>
<?php if($bilgicek['yetki'] == 0) { ?>
<a href="/hesap-ayarlari" class="list-group-item"><i class="fa fa-gear"></i> <?=$dil['hesapayarlari']?></a>
<a href="/onaylanan-gruplarim" class="list-group-item"><i class="fa fa-group"></i> <?=$dil['onaylanangruplarim']?><span class="badge"><?php echo $gruplaa; ?></span></a>
<a href="/onay-bekleyen-gruplarim" class="list-group-item"><i class="glyphicon glyphicon-time"></i> <?=$dil['onaybekleyengruplarim']?><span class="badge"><?php echo $Oonaynekleyengruplar; ?></span></a>
<a href="/grup-ekle" class="list-group-item"><i class="fa fa-plus-square"></i> <?=$dil['grupekle']?></a>
<a href="/cikis-yap.php" class="list-group-item"><i class="glyphicon glyphicon-log-out"></i> <?=$dil['cikisyap']?></a>
<?php } ?>
<?php if($bilgicek['yetki'] == 1) { ?>
<a href="/site-ayarlari" class="list-group-item"><i class="fa fa-gears"></i> <?=$dil['siteayarlari']?></a>
<a href="/reklam-ayarlari" class="list-group-item"><i class="fa fa-usd"></i> <?=$dil['reklamayarlari']?></a>
<a href="/onaylanan-gruplar" class="list-group-item"><i class="fa fa-group"></i> <?=$dil['onaylanangruplar']?> <span class="badge"><?php echo $onaylanan; ?></span></a>
<a href="/onay-bekleyen-gruplarim" class="list-group-item"><i class="glyphicon glyphicon-time"></i> <?=$dil['onaybekleyengruplar']?> <span class="badge"><?php echo $onaybekleyen; ?></span></a>
<a href="/grup-ekle" class="list-group-item"><i class="fa fa-plus-square"></i> <?=$dil['grupekle']?></a>
<a href="/hatali-gruplar" class="list-group-item"><i class="glyphicon glyphicon-remove"></i> <?=$dil['hataligruplar']?></a>
<a href="/kategoriler" class="list-group-item"><i class="fa fa-tasks"></i> <?=$dil['kategoriler']?></a>
<a href="/kategori-ekle" class="list-group-item"><i class="fa fa-plus-square"></i> <?=$dil['kategoriekle']?></a>
<a href="/uyeler" class="list-group-item"><i class="fa fa-users"></i> <?=$dil['uyeler']?></a>
<a href="/uye-ekle" class="list-group-item"><i class="fa fa-plus-square"></i> <?=$dil['uyeekle']?></a>
<?php } ?>
		  </div>
		</div>
<?php } ?>
<?php if(@$_SESSION['giris'] != true) { ?> </div><?php } ?>
  </div>

<div id="sticker">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['kategoriler']?></div>
<div class="list-group">
		  <div class="panel-body">
		  <?php foreach ($kategoriler as $row) { ?>
		  <?php 
				$veriler = $db->select('kategoriler')
				->join('gruplar', '%s.kategori = %s.idsi', 'left')
				->where('onay', '1')
				->where('kategori', $row['idsi'])
				->run();
?>
<?php 
$kat = $row['idsi'];
$sayiyo = $db->prepare("SELECT COUNT(*) FROM gruplar WHERE onay = '1' AND kategori = $kat AND grupdili = '".$secilen."'");
$sayiyo->execute();
$saya = $sayiyo->fetchColumn();
?>

		<?php if ($saya > 0) { ?>
				<?php 
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
?>
		<a href="/kategori/<?php echo $row['seokategori']; ?>" class="list-group-item"> <?php echo $katdil; ?><span class="badge"><?php echo $saya; ?></span> </a> <?php } ?>
		  <?php } ?>
		</div></div>
  </div>
  </div>
  <?php if(!empty($reklambilgi['gruplar'])) { ?>
  <div id="adblock" class="adblock"><font color="#e5ddd5" style="cursor: default;">-</font>
	  <div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['sponsoralani']?></div>
<div class="panel-body"><?php echo $reklambilgi['anasayfaalt'] ?></div>
  </div></div>
  <?php } ?>
</div>