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
		<title><?=$dil['uyeekle']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php require_once "panel/fonksiyon.php";
include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['uyeekle']?></div>
 <div class="panel-body">
<?php if($bilgiler['yetki'] == 0) {
	 die("Buraya erişme yetkin yok");
 } ?>
			<?php
//Kayıt Ol
if (isset($_POST['kaydol'])){
				function checkspecial($string) {
	if (preg_match('/[^a-zA-Z]/', $string)) {
		return false;
	} else {
		return true;
	}
} 
function tokengenerator($uzunluk)
{
$char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"."abcdefghijklmnopqrstuvwxyz"."0123456789";
$str = "";
while(strlen($str) < $uzunluk)
{
$str .= substr($char, (rand() % strlen($char)), 1);
}
return($str);
}
$hacker = sha1(base64_encode(md5(base64_encode($_POST["sifre"])))); 
$id = @$_POST['id'];
$kullaniciadi = @$_POST["kullaniciadi"];
$sifre = @substr($hacker, 5, 32);
$ad = @$_POST["ad"];
$soyad = @$_POST["soyad"];
$email = @$_POST["email"];
$yetki = @$_POST['yetki'];
$token = tokengenerator(255);


$engelle = $db->select('uyeler')
->where('kullaniciadi', $_POST["kullaniciadi"])
->or_where('email', $_POST["email"])
->run();

if(checkspecial($kullaniciadi)) {
if(filter_var($email, FILTER_VALIDATE_EMAIL)){
if(strlen($sifre) < 6 || strlen($kullaniciadi) < 6){
	echo'<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['altikarakter'].'</div>';
} else if(!empty($_POST["kullaniciadi"] and $_POST["sifre"] and $_POST["ad"] and $_POST["soyad"] and $_POST["email"])) {
if($engelle){
	echo '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['kullanilmis'].'</div>';} else {
	$kaydol = $db->insert('uyeler')
	            ->set(array(
					'id' => $id,
	                 'kullaniciadi' => $kullaniciadi,
					 'sifre' => $sifre,
					 'ad' => $ad,
					 'soyad' => $soyad,
					 'email' => $email,
					 'yetki' => $yetki == '' ? "0" : $yetki,
					 'token' => $token
	            ));

 if(@$kaydol){
		echo'<div class="alert alert-success"><strong>'.$dil['basarili'].'</strong> '.$dil['uyeeklendi'].'</div>';
}

}
} else{ echo '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['bosalan'].'</div>';}
}else {echo'<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['gecerlimail'].'</div>'; }
}else {echo'<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['karakter'].'</div>'; }
}
?>
 <form action="" method="post">
	<div class="row">
					<div class="col-md-12">
					<div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['kullaniciadi']?></label>
					<input type="text" class="form-control" placeholder="<?=$dil['kullaniciadi']?>" name="kullaniciadi">
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
					<label><?=$dil['sifre']?></label>
					<input type="password" class="form-control" placeholder="<?=$dil['sifre']?>" name="sifre">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
					<label><?=$dil['eposta']?></label>
					<input type="email" class="form-control" placeholder="<?=$dil['eposta']?>" name="email">
		</div>
	</div>
	<div class="col-md-6">
					<div class="form-group">
					<label><?=$dil['yetki']?></label>
					<select name="yetki" class="form-control" aria-describedby="sizing-addon2">
					<option value="0"><?=$dil['uye']?></option>
					<option value="1"><?=$dil['admin']?></option>
					</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
					<label><?=$dil['isim']?></label>
					<input type="text" class="form-control" placeholder="<?=$dil['isim']?>" name="ad">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
					<label><?=$dil['soyisim']?></label>
					<input type="text" class="form-control" placeholder="<?=$dil['soyisim']?>" name="soyad">
		</div>
	</div>
	
	
	</div>
	
									 <div class="col-md-12">
										<div class="form-group">
										<label><font color="#FFF">Kaydet</font></label>
											<button type="submit" name="kaydol" class="btn btn-primary btn-block"><?=$dil['uyeekle']?></button>
										</div>
									</div>
</div>
									
		</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>