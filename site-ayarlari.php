<?php
require_once "panel/BasicDB.php";
require_once "panel/baglan.php";
require_once "panel/class.upload.php";
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
<?php include "pages/head.php"; ?>
<title><?=$dil['siteayarlari']?> | <?php echo $sitebilgi["baslik"];?></title>
</head>
<body>
<?php require_once "panel/fonksiyon.php"; ?>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['siteayarlari']?></div>
 <div class="panel-body">
 <?php if($bilgiler['yetki'] == 0) {
	 die("Buraya erişme yetkin yok");
 } ?>
 <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?=$dil['sitebasligi']?></label>
                                                <input type="text" class="form-control" placeholder="Site Başlığı" name="baslik" value="<?=$sitebilgi["baslik"];?>">
												
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input type="text" class="form-control" placeholder="Facebook" name="facebook" value="<?=$sitebilgi["facebook"];?>">
												
                                            </div>
                                        </div>
										
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Twitter</label>
                                                <input type="text" class="form-control" placeholder="Twitter" name="twitter" value="<?=$sitebilgi["twitter"];?>">
												
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Instagram</label>
                                                <input type="text" class="form-control" placeholder="Instagram" name="instagram" value="<?=$sitebilgi["instagram"];?>">
												
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Logo</label>
                                                <input type="file" name="logo">
												
                                            </div>
                                        </div>
                                        </div>
										 <div class="col-md-12">
                                            <div class="form-group">
											<label><font color="#FFF">Kaydet</font></label>
                                                <button type="submit" name="siteayar" class="btn btn-primary btn-block"><?=$dil['guncelle']?></button>
                                            </div>
                                        </div>

												</div>
												</form>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>