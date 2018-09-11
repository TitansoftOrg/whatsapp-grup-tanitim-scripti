<?php
require_once "panel/BasicDB.php";
require_once "panel/baglan.php";
$sitebilgi = $db->select('site')
					->run(TRUE);
session_Start();
include "lang.php";
if(@$_SESSION["giris"] == true){
	header("Location: /giris-yap");
    die("Burada olmaman gerekirdi!");
}
$kullanici = @$_SESSION['id'];
$kullanicia = @$_SESSION['kullaniciadi'];
$bilgicek = $db->select('uyeler')
			->where('id', $kullanici)
			->or_where('kullaniciadi', $kullanicia)
			->run(TRUE);
			require_once "panel/fonksiyon.php";
?>

<html>
<head> 
		<title><?=$dil['kayitol']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['kayitol']?></div>
 <div class="panel-body">
<?php
				$uyebilgisi = $db->select('uyeler')
				->run(); ?>
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
		$_SESSION["giris"] = "true";
		$_SESSION["kullaniciadi"] = $kullaniciadi;
		header("Location: /ana-sayfa");
}

}
} else{ echo '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['bosalan'].'</div>';}
}else {echo'<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['gecerlimail'].'</div>'; }
}else {echo'<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['karakter'].'</div>'; }
}
?>
				<div class="col-md-8 col-md-offset-2">
               <form action="" method="post">
			   <div class="form-group"><input name="ad" type="text" class="form-control" id="ad" placeholder="<?=$dil['isim']?>"></div>
			   <div class="form-group"><input name="soyad" type="text" class="form-control" id="soyad" placeholder="<?=$dil['soyisim']?>"></div>
				<div class="form-group"><input name="kullaniciadi" type="text" class="form-control" id="kullaniciadi" placeholder="<?=$dil['kullaniciadi']?>"></div>
                <div class="form-group"><input name="sifre" class="form-control" type="password" id="sifre" placeholder="<?=$dil['sifre']?>"></div>
				<div class="form-group"><input name="email" type="text" class="form-control" id="email" placeholder="<?=$dil['eposta']?>"></div>
					<div class="col-md-6"><button class="btn btn-default btn-block login" name="kaydol" type="submit"><?=$dil['kayitol']?></button></div>
                </form>
				<div class="col-md-6">
				<a href="/giris-yap"><button class="btn btn-default btn-block login"><?=$dil['girisyap']?></button></a></div>
				</div>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>
