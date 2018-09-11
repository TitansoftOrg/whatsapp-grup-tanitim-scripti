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
			
?>

<html>
<head> 
		<title><?=$dil['sifresifirla']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php require_once "panel/fonksiyon.php"; include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['sifresifirla']?></div>
 <div class="panel-body">

				<div class="col-md-8 col-md-offset-2">
				<?php echo @$hatayazdir; ?>
<?php 
$yokla = $db->select('uyeler')
			->where('token', $_GET["token"])
			->run(TRUE); ?>
			<?php if(!$yokla) { echo '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['suresidolmus'].' <u><a style="color: #b94a48" href="/giris-yap">'.$dil['tikla'].'</a></u>'.$dil['tikladevam'].'!</div>'; } else { ?>

               <form action="" method="post">
                <div class="form-group"><input name="sifre" class="form-control" type="password" id="sifre" placeholder="<?=$dil['yenisifre']?>"></div>
				<div class="form-group"><input name="sifret" class="form-control" type="password" id="sifret" placeholder="<?=$dil['yenisifretekrar']?>"></div>
				<button class="btn btn-default btn-block login" name="sifresifirla" type="submit"><?=$dil['sifremiguncelle']?></button>
                </form>
			<?php } ?>
				</div>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>