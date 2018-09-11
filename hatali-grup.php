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
		<title><?=$dil['hataligruplar']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php require_once "panel/fonksiyon.php"; include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['hataligruplar']?></div>
 <div class="panel-body">
 <?php if($bilgiler['yetki'] == 0) {
	 die("Buraya erişme yetkin yok");
 } ?>
			<?php $hatalibilgi = $db->select('gruplar')
									->where('onay', 1)
									->run();
			?>
			<?php foreach ($hatalibilgi as $row) { ?>
			<?php list($en,$boy,$tip) = @getimagesize("https://chat.whatsapp.com/invite/icon/".$row['link'].""); ?>
									<?php
							if ($en < 10) {
							$boyut = "0"; } else { 
							$boyut = "1"; } ?>
							
			<?php if ($boyut == 0) { ?>
			<div class="table table-responsive">
	<table id="exanple" class="table table-striped table-bordered">
      <tr>
        <td><b><?=$dil['grupadi']?></b></td>
        <td width="1%"><b><center><?=$dil['pasiflestir']?></center></b></td>
      </tr>
			<?php $hatalibilgionar = $db->select('gruplar')
										->where('id', $row['id'])
										->run();
			?>
			
			<?php foreach ($hatalibilgionar as $onar) { ?>
			<?php if (isset($_POST['hataligrp'])){

$hataligrp = $db->update('gruplar')
				->where('id', $onar['id'])
            ->set(array(
                 'onay' => 0
            ));
   

if ($hataligrp){
echo "<script>
swal({
  title: '".$dil['basarili']."',
  text: '".$dil['hataligrupbitti']."',
  timer: 4000,
  showCancelButton: false,
  showConfirmButton: false,
  type: 'success'
}).then(
  function () {},
  // handling the promise rejection
  function (dismiss) {
    if (dismiss === 'timer') {
      //console.log('I was closed by the timer')
    }
  }
)
</script>
<meta http-equiv='refresh' content='2;URL=/hatali-gruplar'>";

}
} ?>
<tr>
          <td><?php echo $onar['isim'] ?></td>
          <td><form action="" method="post"><button type="submit" name="hataligrp" class="btn btn-danger btn-block"><?=$dil['pasiflestir']?></button></td>
		  </tr>
			<?php } ?>
			</table>
			</div>

			<?php } ?>
			<?php } ?>
						
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>