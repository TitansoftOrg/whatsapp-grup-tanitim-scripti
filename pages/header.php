<div class="col-lg-10 col-md-offset-1">
<div class="navbar navbar-inverse">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="/ana-sayfa"><i class="fa fa-whatsapp"></i> <?php echo $sitebilgi['baslik']; ?></a>
</div>
<div class="navbar-collapse collapse navbar-inverse-collapse">
<ul class="nav navbar-nav">
<li><a href="/gruplar"><i class="fa fa-users"></i> <?=$dil['tumgruplar']?></a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tasks"></i> <?=$dil['kategoriler']?> <b class="caret"></b></a>
<ul class="dropdown-menu">
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
		<li><a href="/kategori/<?php echo $row['seokategori']; ?>"><?php echo $katdil; ?></a></li> <?php } ?><?php } ?>
</ul>
</li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li class="dropdown">
<?php 
if($_SESSION['dil'] == "tr") {
$current = "Turkey"; } else if($_SESSION['dil'] == "en") {
$current ="United-Kingdom"; } else if($_SESSION['dil'] == "de") {
$current ="Germany"; } else if($_SESSION['dil'] == "fr") {
$current ="France"; } else if($_SESSION['dil'] == "ru") {
$current ="Russia"; } else if($_SESSION['dil'] == "cn") {
$current ="China"; } else if($_SESSION['dil'] == "es") {
$current ="Spain"; } else if($_SESSION['dil'] == "az") {
$current ="Azerbaijan"; } else if($_SESSION['dil'] == "ar") {
$current ="Saudi-Arabia"; } else if($_SESSION['dil'] == "pt") {
$current ="Portugal"; }
?>

<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img style="margin-top: -3px;" src="/dil/img/<?=$current?>.png" width="25"> <?php echo $dil['diladi']; ?> <b class="caret"></b></a>
<style type="text/css">
.iptal {
    -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
    filter: grayscale(100%);
}
</style>
<ul class="dropdown-menu">
		<li><a href="/dil.php?dil=tr"><img style="margin-top: -3px;" src="/dil/img/Turkey.png" width ="25" alt="Türkçe"> Türkçe</a></li>
		<li><a href="/dil.php?dil=en"><img style="margin-top: -3px;" src="/dil/img/United-Kingdom.png" width ="25" alt="English"> English</a></li>
		<li class="dropdown-toggle"><a href="/dil.php?dil=de"><img style="margin-top: -3px;" src="/dil/img/Germany.png" width ="25" alt="Deutsch"> Deutsch</a></li>
		<li class="dropdown-toggle disabled"><a href="#"><img class="iptal" style="margin-top: -3px;" src="/dil/img/France.png" width ="25" alt="Français"> Français</a></li>
		<li class="dropdown-toggle disabled"><a href="#"><img class="iptal" style="margin-top: -3px;" src="/dil/img/Russia.png" width ="25" alt="Pусский"> Pусский</a></li>
		<li class="dropdown-toggle disabled"><a href="#"><img class="iptal" style="margin-top: -3px;" src="/dil/img/China.png" width ="25" alt="中国"> 中国</a></li>
		<li class="dropdown-toggle disabled"><a href="#"><img class="iptal" style="margin-top: -3px;" src="/dil/img/Spain.png" width ="25" alt="Español"> Español</a></li>
		<li class="dropdown-toggle disabled"><a href="#"><img class="iptal" style="margin-top: -3px;" src="/dil/img/Azerbaijan.png" width ="25" alt="Azərbaycan"> Azərbaycan</a></li>
		<li class="dropdown-toggle disabled"><a href="#"><img class="iptal" style="margin-top: -3px;" src="/dil/img/Saudi-Arabia.png" width ="25" alt="العربية"> العربية</a></li>
		<li class="dropdown-toggle disabled"><a href="#"><img class="iptal" style="margin-top: -3px;" src="/dil/img/Portugal.png" width ="25" alt="Português"> Português</a></li>
</ul>
</li>
<?php if(@$_SESSION['giris'] != true) { ?> <li><a href="/giris-yap"><i class="fa fa-user"></i> <?php echo $dil['girisyap']; ?></a></li> <li><a href="/kayit-ol"><i class="fa fa-plus-square"></i> <?php echo $dil['kayitol']; ?></a></li><?php } ?>
<?php if(@$_SESSION['giris'] == true) { ?>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $bilgicek['ad']; ?> <?php echo $bilgicek['soyad']; ?> <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="/hesap-ayarlari"><i class="fa fa-gear"></i> <?=$dil['hesapayarlari']?></a></li>
<li><a href="/onaylanan-gruplarim"><i class="fa fa-group"></i> <?=$dil['onaylanangruplarim']?></a></li>
<li><a href="/onay-bekleyen-gruplarim"><i class="glyphicon glyphicon-time"></i> <?=$dil['onaybekleyengruplarim']?></a></li>
<li><a href="/cikis-yap"><i class="glyphicon glyphicon-log-out"></i> <?=$dil['cikisyap']?></a></li>
<?php if($bilgicek['yetki'] == 1) { ?><li class="divider"></li>
<li><a href="/onay-bekleyen-gruplarim"><i class="glyphicon glyphicon-time"></i> <?=$dil['onaybekleyengruplar']?></a></li>
<li><a href="/site-ayarlari"><i class="fa fa-pencil"></i> <?=$dil['siteayarlari']?></a></li>
<li><a href="/reklam-ayarlari"><i class="fa fa-usd"></i> <?=$dil['reklamayarlari']?></a></li>
<li><a href="/uyeler"><i class="fa fa-users"></i> <?=$dil['uyeler']?></a></li>
<li><a href="/kategoriler"><i class="fa fa-list"></i> <?=$dil['kategoriler']?></a></li><?php } ?>
</ul>
</li>
<?php } ?>
</ul>
</div>
</div>
</div>