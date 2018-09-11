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
		<title><?=$dil['grupekle']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php require_once "panel/fonksiyon.php"; include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['grupekle']?></div>
 <div class="panel-body">
<script src="ckeditor/ckeditor.js"></script>
 <form action="grup-ekle.php" method="post">
					<div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['grupadi']?></label>
					<input type="text" class="form-control" placeholder="<?=$dil['grupadi']?>" name="isim" required>
		</div>
	</div>
	<div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['kategori']?></label>
					<select name="kategori" class="form-control" aria-describedby="sizing-addon2">
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
	<div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['onaydurumu']?></label>
					<select name="onay" class="form-control" aria-describedby="sizing-addon2">
					<option value="1"><?=$dil['onayla']?></option>
					<option value="0"><?=$dil['onaybekliyor']?></option>
</select>
		</div>
	</div> <?php } ?>
	<div class="col-md-8">
					<div class="form-group">
					<label><?=$dil['link']?></label>
					<input type="text" class="form-control" placeholder="<?=$dil['link']?>" name="link" required>
		</div>
	</div>
	<div class="col-md-4">
					<div class="form-group">
					<label><?=$dil['uyesayisi']?></label>
					<input type="text" class="form-control" placeholder="<?=$dil['uyesayisi']?>" name="uyesayisi" required>
		</div>
	</div>
	<div class="col-md-12">
	<?php 
if($_SESSION['dil'] == "tr") {
$gecerli = "Türkçe"; } else if($_SESSION['dil'] == "en") {
$gecerli ="English"; } else if($_SESSION['dil'] == "de") {
$gecerli ="Deutsch"; } else if($_SESSION['dil'] == "fr") {
$gecerli ="Français"; } else if($_SESSION['dil'] == "ru") {
$gecerli ="Pусский"; } else if($_SESSION['dil'] == "cn") {
$gecerli ="中国"; } else if($_SESSION['dil'] == "es") {
$gecerli ="Español"; } else if($_SESSION['dil'] == "az") {
$gecerli ="Azərbaycan"; } else if($_SESSION['dil'] == "ar") {
$gecerli ="العربية"; } else if($_SESSION['dil'] == "pt") {
$gecerli ="Português"; }
?>
					<div class="form-group">
					<label><?=$dil['grupdili']?></label>
					<select name="grupdili" class="form-control" aria-describedby="sizing-addon2">
					<option hidden selected value="<?=$_SESSION['dil']?>"><?php echo $gecerli?></option>
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
						<textarea type="text" name="aciklama" id="editor" class="ckeditor form-control" rows="8" required></textarea>
				        <script>
				            CKEDITOR.replace('editor');
				            config.extraPlugins = 'uploadwidget';
				        </script>				
						</div>
	</div> 
	<div class="col-md-12">
										<div class="form-group">
										<label><font color="#FFF">Kaydet</font></label>
											<button type="submit" name="grupekle" class="btn btn-primary btn-block"><?=$dil['grupekle']?></button>
										</div>
									</div>
	</div>
	
									 
</div>
</div>

<?php include "pages/sidebar.php"; ?>

</body>
</html>