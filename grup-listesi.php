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
		<title>Gruplar | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading">Gruplar</div>
 <div class="panel-body">
<?php
	if($bilgiler["yetki"] == 0){
	echo "<meta http-equiv='refresh' content='0;URL=gruplarim.php'>";
    die('Buraya erişme yetkin yok birader. Geri bas haydeeee');
}
?>
				<div class="table table-responsive">
	<table id="exanple" class="table table-striped table-bordered">
      <tr>
        <td><b>Grup adı</b></td>
		<td><b>Kategori</b></td>
		<td><b>Sahibi</b></td>
		<td width="1%"><b><center>Üyeler</center></b></td>
        <td width="1%"><b>Link</b></td>
		<td width="1%"><b>Aktif/Pasif</b></td>
        <td width="1%"><b><center>Düzenle</center></b></td>
        <td width="1%"><b><center>Sil</center></b></td>
      </tr>
<?php
if ($gruplar){
  foreach ($gruplar as $row){
?>
<?php
$sahip = $db->select('uyeler')
->where('id', $row['sahibi'])
->run(TRUE);
?>
<?php
	if ($row['sahibi'] == $sahip['id']) {
		$sahipyaz = $sahip['kullaniciadi']; 
	}
	?>
		<tr>
          <td><?php echo $row['isim'] ?></td>
		  <td><?php echo $row['kategoriadi'] ?></td>
		  <td><?php echo $sahipyaz;?></td>
          <td><center><?php echo $row['uyesayisi'] ?></center></td>
		  <td><a class="btn btn-default btn-xxl" href="https://chat.whatsapp.com/<?php echo $row['link'] ?>"><i class="fa fa-chevron-right"></i></a></button></td>
          <td><?php
		  if($row["onay"] == 0){
	echo '<form name="form2" action="grup-onayla.php" method="POST">
			<input type="hidden" name="id" value="'.$row["id"].'">
			<input type="hidden" name="onay" value="'.$row["onay"].'">
			<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aktifleştir</button>
		   </form>';
		  }  ?>
<?php
		  if($row["onay"] == 1){
	echo '<form name="form2" action="grup-kaldir.php" method="POST">
			<input type="hidden" name="id" value="'.$row["id"].'">
			<input type="hidden" name="onay" value="'.$row["onay"].'">
			<button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Pasifleştir</button>
		   </form>';
		  }  ?>		 </td>
          <td><center><a href="grup-duzenle/<?=$row['id']?>"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a></center></td>
          <td><center><a href="grup-sil.php?id=<?=$row['id']?>"><button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a></center>
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
