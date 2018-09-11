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
		<title><?=$dil['onaybekleyengruplarim']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php require_once "panel/fonksiyon.php";
include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?php if($bilgiler['yetki'] == 0) { ?><?=$dil['onaybekleyengruplarim']?><?php } ?> <?php if($bilgiler['yetki'] == 1) { ?><?=$dil['onaybekleyengruplar']?><?php } ?></div>
 <div class="panel-body">
<?php if($bilgiler['yetki'] == 0) { ?><div class="table table-responsive">
	<table id="exanple" class="table table-striped table-bordered">
      <tr>
        <td><b><?=$dil['grupadi']?></b></td>
		<td><b><?=$dil['kategori']?></b></td>
		<td width="1%"><b><center><?=$dil['uyeler']?></center></b></td>
        <td width="1%"><b><?=$dil['link']?></b></td>
		<td width="15%"><b><?=$dil['onaydurumu']?></b>
      </tr>
<?php
if ($gruplarimonay){
  foreach ($gruplarimonay as $row){
?>
<?php
	if ($row['onay']=="1") {
		$onayi = $dil['onaylandi'];
	}else if($row['onay']=="0"){
		$onayi = $dil['onaybekliyor'];
	}
	?>
	<?php
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
?>
		<tr>
          <td><?php echo $row['isim'] ?></td>
		  <td><?php echo $katdil ?></td>
          <td><center><?php echo $row['uyesayisi'] ?></center></td>
		  <td><a class="btn btn-default btn-xxl" href="https://chat.whatsapp.com/<?php echo $row['link'] ?>"><i class="fa fa-chevron-right"></i></a></button></td>
        <td><?php echo $onayi ?></td>
        </tr>
		<?php
  }
}

				?>	
    </table>
              </div><?php } ?>
			   <?php if($bilgiler['yetki'] == 1) { ?><div class="table table-responsive">
	<table id="exanple" class="table table-striped table-bordered">
      <tr>
        <td><b><?=$dil['grupadi']?></b></td>
		<td><b><?=$dil['kategori']?></b></td>
		<td width="1%"><b><?=$dil['sahibi']?></b></td>
		<td width="1%"><b><center><?=$dil['uyeler']?></center></b></td>
        <td width="1%"><b><?=$dil['link']?></b></td>
		<td width="1%"><b><center><?=$dil['onayla']?></center></b>
		<td width="1%"><b><center><?=$dil['duzenle']?></center></b></td>
        <td width="1%"><b><center><?=$dil['sil']?></center></b></td>
      </tr>
<?php
if ($admingrup){
  foreach ($admingrup as $row){
?>
<?php
	if ($row['onay']=="1") {
		$onayi = $dil['onaylandi'];
	}else if($row['onay']=="0"){
		$onayi = $dil['onaybekliyor'];
	}
	?>
	<?php
$sahip = $db->select('uyeler')
->where('id', $row['sahibi'])
->run(TRUE);
?>
<?php
	if ($row['sahibi']== $sahip['id']) {
		$sahipyaz = $sahip['kullaniciadi']; 
	}
	?>
		<?php
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
?>
		<tr>
          <td><?php echo $row['isim'] ?></td>
		  <td><?php echo $katdil ?></td>
		  <td><?php echo $sahipyaz ?></td>
          <td><center><?php echo $row['uyesayisi'] ?></center></td>
		  <td><a class="btn btn-default btn-xxl" href="https://chat.whatsapp.com/<?php echo $row['link'] ?>"><i class="fa fa-chevron-right"></i></a></button></td>
        <td><?php
	echo '<form style="margin-bottom: 0em;"name="form2" action="panel/grup-onayla.php" method="POST">
			<input type="hidden" name="id" value="'.$row["id"].'">
			<input type="hidden" name="onay" value="'.$row["onay"].'">
			<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.$dil['onayla'].'</button>
		   </form>'; ?></td>
		   <td><center><a href="grup-duzenle/<?=$row['id']?>"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a></center></td>
          <td><center><a href="/panel/grup-sil-2.php?id=<?=$row['id']?>"><button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></a></center>
		  </td>
        </tr>
		<?php
  }
}

				?>	
    </table>
              </div><?php } ?>
            </div>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>