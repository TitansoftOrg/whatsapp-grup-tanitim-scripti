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
		<title><?=$dil['reklamayarlari']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php require_once "panel/fonksiyon.php";
include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['reklamayarlari']?></div>
 <div class="panel-body">
 <?php if($bilgiler['yetki'] == 0) {
	 die("Buraya erişme yetkin yok");
 } ?>
 <form action="" method="post">
	 
                                    <div class="row">
                                        <div class="col-md-6">
                                           <div class="form-group">
					<label><?=$dil['anasayfabir']?></label>
						<textarea type="text" name="anasayfaust" class="ckeditor form-control" rows="8"><?php echo $reklambilgi['anasayfaust'] ?></textarea>	
						</div>
                                        </div>
										<div class="col-md-6">
                                           <div class="form-group">
					<label><?=$dil['anasayfaiki']?></label>
						<textarea type="text" name="anasayfaalt" class="ckeditor form-control" rows="8"><?php echo $reklambilgi['anasayfaalt'] ?></textarea>
						</div>
                                        </div>
											<div class="col-md-6">
                                           <div class="form-group">
					<label><?=$dil['gruplistesi']?></label>
						<textarea type="text" name="gruplar" class="ckeditor form-control" rows="8"><?php echo $reklambilgi['gruplar'] ?></textarea>			
						</div>
                                        </div>
										<div class="col-md-6">
                                           <div class="form-group">
					<label><?=$dil['uyepaneli']?></label>
						<textarea type="text" name="panel" class="ckeditor form-control" rows="8"><?php echo $reklambilgi['panel'] ?></textarea>			
						</div>
                                        </div>
										 
										 <div class="col-md-12">
                                            <div class="form-group">
											<label><font color="#FFF">Kaydet</font></label>
                                                <button type="submit" name="reklamayar" class="btn btn-primary btn-block"><?=$dil['guncelle']?></button>
                                            </div>
                                        </div>
</div>
												</div>
</form>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>