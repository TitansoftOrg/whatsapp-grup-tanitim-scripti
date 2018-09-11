<?php error_reporting(0); ?>
<?php
$uye_id = @$_SESSION['id'];
$bilgiler = $db->select('uyeler')
			->where('id', $uye_id)
			->run(TRUE);
			?>
			<?php
			$getcek = @$_GET['id'];
			$getbilgi = $db->select('gruplar')
			->where('id', $getcek)
			->run(TRUE);
			?>
<?php
$reklambilgi = $db->select('reklamlar')
->run(TRUE)
?>
<?php
$gruplar = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->run();
?>
<?php
$grup = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('onay', '1')
				->orderby('id', 'desc')
				->run();
?>
<?php
$gruplarim = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('sahibi', $bilgiler['id'])
				->run();
?>
<?php
$admingrup = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('onay', '0')
				->run();
?>
<?php
$kategoriler = $db->select('kategoriler')
->run();
?>
<?php
$getkategori = $db->select('kategoriler')
->where('idsi', $getbilgi['kategori'])
->run(TRUE);
?>
<?php
$getuyeler = $db->select('uyeler')
->where('id', $getbilgi["sahibi"])
->run(TRUE);
?>
<?php
$uyeduzen = $db->select('uyeler')
->where('id', $getcek)
->run(TRUE);
?>
<?php
$uyeler = $db->select('uyeler')
->run();
?>
<?php
//Site Ayarları
if (isset($_POST['siteayar'])){
	$logo = new Upload($_FILES['logo']);
	$logo->allowed = array ( 'image/*' );
	$logo->allowed = array ( 'image/*' );
   if ( $logo->uploaded ) {
	   $logo->file_new_name_body = seo($_POST['baslik']);
   $logo->Process('upload/logo');
   }
$baslik = $_POST["baslik"];
$facebook = $_POST["facebook"];
$twitter = $_POST["twitter"];;
$instagram = $_POST["instagram"];
$siteayar = $db->update('site')
            ->set(array(
                 'baslik' => $baslik,
				 'logo' => $logo->file_dst_name == '' ? $sitebilgi["logo"] : $logo->file_dst_name,
				 'facebook' => $facebook,
				 'twitter' => $twitter,
				 'instagram' => $instagram
            ));
   


if ($siteayar){
echo "<script>
swal({
  title: 'Başarılı!',
  text: 'Site bilgileri güncellendi.',
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
<meta http-equiv='refresh' content='2;URL=site-ayarlari.php'>";

}
}
?>
<?php
function seo($s) {
 $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',',"'",'"','!');
 $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','',"",'','');
 $s = str_replace($tr,$eng,$s);
 $s = strtolower($s);
 $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
 $s = preg_replace('/\s+/', '-', $s);
 $s = preg_replace('|-+|', '-', $s);
 $s = preg_replace('/#/', '', $s);
 $s = str_replace('.', '', $s);
 $s = trim($s, '-');
 return $s;
}
?>
<?php
//Reklam Ayarları
if (isset($_POST['reklamayar'])){
$anasayfaust = $_POST["anasayfaust"];
$anasayfaalt = $_POST["anasayfaalt"];
$gruplar = $_POST["gruplar"];
$panel = $_POST["panel"];


$reklamayar = $db->update('reklamlar')
			->where('id', 1)
            ->set(array(
                 'anasayfaust' => $anasayfaust,
				 'anasayfaalt' => $anasayfaalt,
				 'gruplar' => $gruplar,
				 'panel' => $panel
            ));
if ($reklamayar){
echo "<script>
swal({
  title: 'Başarılı!',
  text: 'Reklam ayarları güncellendi.',
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
<meta http-equiv='refresh' content='2;URL=reklam-ayarlari.php'>";

}
}
?>
<?php
//Kategori Ekleme
if (isset($_POST['kategoriekle'])){
$kategoriadi = $_POST["kategoriadi"];
$seokategori = seo($_POST["kategoriadi"]);
$kategoriekle = $db->insert('kategoriler')
            ->set(array(
                 'kategoriadi' => $kategoriadi,
				 'seokategori' => $seokategori
            ));
   

if ($kategoriekle){
echo "<script>
swal({
  title: 'Başarılı!',
  text: 'Kategori eklendi.',
  showCancelButton: false,
  showConfirmButton: true,
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
</script>";

}
}
?>
<?php
//Grup Ekle
if (isset($_POST['grupekle'])){
$isim = @$_POST["isim"];
$kategori = @$_POST["kategori"];
$sahibi = @$_POST["sahibi"];
$aciklama = @$_POST["aciklama"];
$onay = @$_POST["onay"];
$link = @$_POST["link"];
$uyesayisi = @$_POST["uyesayisi"];
$grupekle = $db->insert('gruplar')
            ->set(array(
                 'isim' => $isim,
				 'kategori' => $kategori,
				 'sahibi' => $sahibi == '' ? $bilgiler["id"] : $sahibi,
				 'aciklama' => $aciklama,
				 'onay' => $onay == '' ? "0" : $onay,
				 'link' => $link,
				 'uyesayisi' => $uyesayisi
            ));
   

if ($grupekle){
echo "<script>
swal({
  title: 'Başarılı!',
  text: 'Grup eklendi.',
  showCancelButton: false,
  showConfirmButton: true,
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
</script>";

}
}
?>
<?php
//Grup Düzenle
if (isset($_POST['grupduzenle'])){
$isim = @$_POST["isim"];
$kategori = @$_POST["kategori"];
$sahibi = @$_POST["sahibi"];
$aciklama = @$_POST["aciklama"];
$onay = @$_POST["onay"];
$link = @$_POST["link"];
$uyesayisi = @$_POST["uyesayisi"];
$grupduzenle = $db->update('gruplar')
			->where('id', $_GET["id"])
            ->set(array(
                 'isim' => $isim,
				 'kategori' => $kategori,
				 'sahibi' => $sahibi == '' ? $getbilgi["sahibi"] : $sahibi,
				 'aciklama' => $aciklama,
				 'onay' => $onay == '' ? "0" : $onay,
				 'link' => $link,
				 'uyesayisi' => $uyesayisi
            ));
   

if ($grupduzenle){
echo "<script>
swal({
  title: 'Başarılı!',
  text: 'Grup Düzenlendi.',
  showCancelButton: false,
  showConfirmButton: true,
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
</script>";

}
}
?>
<?php
//Kategori Düzenle
if (isset($_POST['kategoriduzenle'])){

$kategoriadi = $_POST["kategoriadi"];
$seokategori = seo($_POST["kategoriadi"]);
$kategoriduzenle = $db->update('kategoriler')
			->where('idsi', $_GET['idsi'])
            ->set(array(
                 'kategoriadi' => $kategoriadi,
				 'seokategori' => $seokategori
            ));
   

if ($kategoriduzenle){
echo "<script>
swal({
  title: 'Başarılı!',
  text: 'Kategori Düzenlendi.',
  showCancelButton: false,
  showConfirmButton: true,
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
</script>";

}
}
?>
<?php
//Üye Düzenle
if (isset($_POST['uyeduzenle'])){
$kullaniciadi = @$_POST["kullaniciadi"];
$sifre = @$_POST["sifre"];
$ad = @$_POST["ad"];
$soyad = @$_POST["soyad"];
$email = @$_POST["email"];
$yetki = @$_POST['yetki'];
$uyeduzenle = $db->update('uyeler')
			->where('id', $_GET["id"])
            ->set(array(
                 'kullaniciadi' => $kullaniciadi,
				 'sifre' => $sifre == '' ? $uyeduzen["sifre"] : $sifre,
				 'ad' => $ad,
				 'soyad' => $soyad,
				 'email' => $email,
				 'yetki' => $yetki
            ));
   

if ($uyeduzenle){
echo "<script>
swal({
  title: 'Başarılı!',
  text: 'Üye güncellendi.',
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
<meta http-equiv='refresh' content='2;URL=uye-duzenle.php?id=".$_GET['id']." '>";

}
}
?>
<?php
//Hesap Ayarları
if (isset($_POST['hesapayarlari'])){

$kullaniciadi = @$_POST["kullaniciadi"];
$sifre = @$_POST["sifre"];
$ad = @$_POST["ad"];
$soyad = @$_POST["soyad"];
$email = @$_POST["email"];
$yetki = @$_POST['yetki'];
$id = $_SESSION["id"];
 
$hesapayarlari = $db->update('uyeler')
            ->where('id', $id)
            ->set(array(
                 'kullaniciadi' => $kullaniciadi,
				 'sifre' => $sifre == '' ? $bilgiler["sifre"] : $sifre,
				 'ad' => $ad,
				 'soyad' => $soyad,
				 'email' => $email,
				 'yetki' => $bilgiler["yetki"]
            ));
  

if ($hesapayarlari){
echo "<script>
swal({
  title: 'Başarılı!',
  text: 'Hesap bilgileri güncellendi.',
  showCancelButton: false,
  showConfirmButton: true,
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
<meta http-equiv='refresh' content='2;URL=hesap-ayarlari.php'>";

}
}
?>
<?php 
$grupid = @$_GET['id'];
$grupgor = $db->select('gruplar')
			->where('id', $grupid)
			->run(TRUE);
			?>
<?php
$kategoridsi = @$_GET['idsi'];
$kategoriget = $db->select('kategoriler')
->where('idsi', $kategoridsi)
			->run(TRUE);
			?>
<?php 
$kategoriismi = @$_GET['seokategori'];
$kategoricek = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('onay', '1')
				->where('seokategori', $kategoriismi)
				->orderby('id', 'desc')
				->run();
?>
<?php
$kategoriyazdir = $db->select('kategoriler')
->where('seokategori', $kategoriismi)
->run(TRUE);
?>
