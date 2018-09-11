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
		<title><?=$dil['grupduzenle']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php require_once "panel/fonksiyon.php"; include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['grupduzenle']?></div>
 <div class="panel-body">
 <div class="panel-body">
 <script src="/ckeditor/ckeditor.js"></script>
 <form action="" method="post">
	<div class="row">
					<div class="col-md-12">
					<div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['grupadi']?></label>
					<input type="text" class="form-control" value="<?=$getbilgi['isim'];?>" name="isim" required>
		</div>
	</div>
	<?php
	if($_SESSION['dil'] == "tr") {
$getkategorikatdil = $getkategori['kategoritr']; } else if($_SESSION['dil'] == "en") {
$getkategorikatdil = $getkategori['kategorien']; } else if($_SESSION['dil'] == "de") {
$getkategorikatdil = $getkategori['kategoride']; } else if($_SESSION['dil'] == "fr") {
$getkategorikatdil = $getkategori['kategorifr']; } else if($_SESSION['dil'] == "ru") {
$getkategorikatdil = $getkategori['kategoriru']; } else if($_SESSION['dil'] == "cn") {
$getkategorikatdil = $getkategori['kategoricn']; } else if($_SESSION['dil'] == "es") {
$getkategorikatdil = $getkategori['kategories']; } else if($_SESSION['dil'] == "az") {
$getkategorikatdil = $getkategori['kategoriaz']; } else if($_SESSION['dil'] == "ar") {
$getkategorikatdil = $getkategori['kategoriar']; } else if($_SESSION['dil'] == "pt") {
$getkategorikatdil = $getkategori['kategoript']; }
?>
	<div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['kategori']?></label>
					<select name="kategori" class="form-control" aria-describedby="sizing-addon2">
					<option hidden selected value="<?php echo $getbilgi['kategori']; ?>"><?php echo $getkategorikatdil ?></option>
					<?php
if ($kategoriler){
  foreach ($kategoriler as $row){
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
			echo '<option value="'.$row['idsi'].'">'.$katdil.'</option>';
									
									
  }
}
?>
</select>
		</div>
	</div>
	<?php if($bilgiler["yetki"] == 1){ ?><div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['grupsahibi']?></label>
					<select name="sahibi" class="form-control" aria-describedby="sizing-addon2">
					<option hidden selected value="<?php echo $getbilgi['sahibi']; ?>"><?php echo $getuyeler['kullaniciadi'] ?> (<?php echo $getuyeler['ad']; ?> <?=$getuyeler['soyad']; ?>)</option>
					<?php
if ($uyeler){
  foreach ($uyeler as $row){
    
			echo '<option value="'.$row['id'].'">'.$row['kullaniciadi'].' ('.$row['ad'].' '.$row['soyad'].')</option>';
									
									
  }
}
?>
</select>
		</div>
	</div>
	<?php
	if ($getbilgi['onay']=="1") {
		$onayi = $dil['onaylandi'];
	}else if($getbilgi['onay']=="0"){
		$onayi =  $dil['onaybekliyor'];
	}
	?>
	<div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['onaydurumu']?></label>
					<select name="onay" class="form-control" aria-describedby="sizing-addon2">
					<option hidden selected value="<?php echo $getbilgi['onay']; ?>"><?php echo $onayi; ?></option>
					<option value="1"><?=$dil['onayla']?></option>
					<option value="0"><?=$dil['onaybekliyor']?></option>
</select>
		</div>
	</div> <?php } ?>
	<div class="col-md-8">
					<div class="form-group">
					<label><?=$dil['link']?></label>
					<input type="text" class="form-control" value="<?=$getbilgi['link'];?>" name="link" required>
		</div>
	</div>
	<div class="col-md-4">
					<div class="form-group">
					<label><?=$dil['uyesayisi']?></label>
					<input type="text" class="form-control" value="<?=$getbilgi['uyesayisi'];?>" name="uyesayisi" required>
		</div>
	</div>
	</div> 
		<div class="col-md-12">
	<?php 
if($getbilgi['grupdili'] == "tr") {
$gecerli = "Türkçe"; } else if($getbilgi['grupdili'] == "en") {
$gecerli ="English"; } else if($getbilgi['grupdili'] == "de") {
$gecerli ="Deutsch"; } else if($getbilgi['grupdili'] == "fr") {
$gecerli ="Français"; } else if($getbilgi['grupdili'] == "ru") {
$gecerli ="Pусский"; } else if($getbilgi['grupdili'] == "cn") {
$gecerli ="中国"; } else if($getbilgi['grupdili'] == "es") {
$gecerli ="Español"; } else if($getbilgi['grupdili'] == "az") {
$gecerli ="Azərbaycan"; } else if($getbilgi['grupdili'] == "ar") {
$gecerli ="العربية"; } else if($getbilgi['grupdili'] == "pt") {
$gecerli ="Português"; }
?>
					<div class="form-group">
					<label><?=$dil['grupdili']?></label>
					<select name="grupdili" class="form-control" aria-describedby="sizing-addon2">
					<option hidden selected value="<?=$getbilgi['grupdili']?>"><?php echo $gecerli?></option>
					<option value="tr">Türkçe</option>
					<option value="en">English</option>
					<option value="de">Deutsch</option>
					<option value="fr">Français</option>
					<option value="ru">Pусский</option>
					<option value="cn">中国</option>
					<option value="es">Español</option>
					<option value="az">Azərbaycan</option>
					<option value="ar">العربية</option>
					<option value="pt">Português</option>
</select>
		</div>
	</div>
	<div class="col-md-12">
					<div class="form-group">
					<label><?=$dil['grupaciklamasi']?></label>
						<textarea type="text" name="aciklama" id="editor" class="ckeditor form-control" rows="8" required><?=$getbilgi['aciklama'];?></textarea>
				        <script>
				            CKEDITOR.replace('editor');
				            config.extraPlugins = 'uploadwidget';
				        </script>				
						</div>
	</div> 
	</div>
	
									 <div class="col-md-12">
										<div class="form-group">
										<label><font color="#FFF">Kaydet</font></label>
											<button type="submit" name="grupduzenle" class="btn btn-primary btn-block"><?=$dil['grupguncelle']?></button>
										</div>
									</div>
</div>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>