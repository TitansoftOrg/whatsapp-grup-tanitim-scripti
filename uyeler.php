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
		<title><?=$dil['uyeler']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['uyeler']?></div>
 <div class="panel-body">
<?php if($bilgiler['yetki'] == 0) {
	 die("Buraya erişme yetkin yok");
 } ?>
 <div class="table table-responsive">
	<table id="exanple" class="table table-striped table-bordered">
      <tr>
        <td width="1%"><b>ID</b></td>
		<td><b><?=$dil['isim']?></b></td>
		<td><b><?=$dil['kullaniciadi']?></b></td>
		<td><b><?=$dil['eposta']?></b></td>
		<td width="1%"><b><?=$dil['adminuye']?></b></td>
        <td width="1%"><b><center><?=$dil['duzenle']?></center></b></td>
        <td width="1%"><b><center><?=$dil['sil']?></center></b></td>
      </tr>
<?php
if ($uyeler){
  foreach ($uyeler as $row){
?>
		<tr>
			<td><?php echo $row['id'] ?></td>
          <td><?php echo $row['ad'] ?> <?php echo $row['soyad'] ?></td>
		  <td><?php echo $row['kullaniciadi'] ?></td>
		  <td><?php echo $row['email'] ?></td>
          <td><?php
		  if($row["yetki"] == 0){
	echo '<form name="form2" action="/panel/admin-yap.php" method="POST">
			<input type="hidden" name="id" value="'.$row["id"].'">
			<input type="hidden" name="yetki" value="'.$row["yetki"].'">
			<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.$dil['adminyap'].'</button>
		   </form>';
		  }  ?>
<?php
		  if($row["yetki"] == 1){
	echo '<form name="form2" action="/panel/uye-yap.php" method="POST">
			<input type="hidden" name="id" value="'.$row["id"].'">
			<input type="hidden" name="yetki" value="'.$row["yetki"].'">
			<button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> '.$dil['uyeyap'].'</button>
		   </form>';
		  }  ?>		 </td>
          <td><center><a href="uye-duzenle/<?=$row['id']?>"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a></center></td>
          <td><center>
		  <?php
		   if($bilgiler["yetki"] == 1){
	echo '<form name="form2" action="/panel/uye-sil.php" method="POST">
			<input type="hidden" name="id" value="'.$row["id"].'">
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