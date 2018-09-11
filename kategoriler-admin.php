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
			require_once "panel/fonksiyon.php";
?>

<html>
<head> 
		<title><?=$dil['kategoriler']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['kategoriler']?></div>
 <div class="panel-body">
 <?php if($bilgiler['yetki'] == 0) {
	 die("Buraya erişme yetkin yok");
 } ?>
 <div class="table table-responsive">
	<table id="exanple" class="table table-striped table-bordered">
      <tr>
        <td><b><?=$dil['kategoriadi']?></b></td>
        <td width="1%"><b><center><?=$dil['duzenle']?></center></b></td>
        <td width="1%"><b><center><?=$dil['sil']?></center></b></td>
      </tr>
<?php
if ($kategoriler){
  foreach ($kategoriler as $row){
?>
		<tr>
          <td><?php echo $row['kategoriadi'] ?></td>
          <td><center>
		  <?php
		   if($bilgiler["yetki"] == 1){
	echo '
		   <a href="kategori-duzenle/'.$row["idsi"].'"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>';}
		   if($bilgiler["yetki"] != 1){
		   echo '<button class="btn btn-danger" disabled><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';}
		   ?></center></td>
          <td><center>
		  <?php
		   if($bilgiler["yetki"] == 1){
	echo '
		  <form name="form2" action="/panel/kategori-sil.php" method="POST">
			<input type="hidden" name="idsi" value="'.$row["idsi"].'">
			<button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
		   </form>';}
		   if($bilgiler["yetki"] != 1){
		   echo '<button class="btn btn-danger" disabled><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>';}
		   ?></center>
		  </td>
        </tr>
		<?php
  }
}

?>	
    </table>
	<?php

if($bilgiler["yetki"] != 1){
    echo "*Bu alanda düzenleme yetkiniz bulunmadığı için sadece görüntüleyebilirsiniz!";
}

?>
            </div>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>