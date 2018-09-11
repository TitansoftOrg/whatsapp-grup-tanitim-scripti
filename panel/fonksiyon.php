<?php error_reporting(0); ?>
<?php
$uye_id = @$_SESSION['id'];
$kullanicias = @$_SESSION['kullaniciadi'];
$bilgiler = $db->select('uyeler')
			->where('id', $uye_id)
			->or_where('kullaniciadi', $kullanicias)
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
$sayfa = @$_GET['sayfa'];
$sayfa_limiti = 9;
if($sayfa == '' || $sayfa == 1)
{
	$sayfa1 = 0;
}else{
$sayfa1  = ($sayfa * $sayfa_limiti) - $sayfa_limiti;
}
					
$grup = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('onay', '1')
				->where('grupdili', $secilen)
				->orderby('id', 'desc')
				->limit($sayfa1, $sayfa_limiti)
				->run();

				$satir_sayisi = $db->query("SELECT * FROM gruplar WHERE onay = '1' AND grupdili = '".$secilen."'")->rowCount();
?>
<?php $grupz = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('onay', '1')
				->orderby('id', 'desc')
				->run();
				?>
<?php
$gruplarim = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('sahibi', $bilgiler['id'])
				->orderby('id', 'desc')
				->where('onay', '1')
				->run();
?>
<?php
$gruplarimonay = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('sahibi', $bilgiler['id'])
				->where('onay', '0')
				->orderby('id', 'desc')
				->run();
?>
<?php
$admingrup = $db->select('gruplar')
				->join('kategoriler', '%s.idsi = %s.kategori', 'left')
				->where('onay', '0')
				->orderby('id', 'desc')
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
  title: '".$dil['basarili']."',
  text: '".$dil['siteayarlariguncellendi']."',
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
<meta http-equiv='refresh' content='2;URL=/site-ayarlari'>";

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
  title: '".$dil['basarili']."',
  text: '".$dil['reklamayalariguncellendi']."',
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
$kategoriar = $_POST["kategoriar"];
$kategoriaz = $_POST["kategoriaz"];
$kategoricn = $_POST["kategoricn"];
$kategoride = $_POST["kategoride"];
$kategorien = $_POST["kategorien"];
$kategories = $_POST["kategories"];
$kategorifr = $_POST["kategorifr"];
$kategoript = $_POST["kategoript"];
$kategoriru = $_POST["kategoriru"];
$kategoritr = $_POST["kategoritr"];
$kategoriekle = $db->insert('kategoriler')
            ->set(array(
                 'kategoriadi' => $kategoriadi,
				 'seokategori' => $seokategori,
				 'kategoriar' => $kategoriar,
				 'kategoriaz' => $kategoriaz,
				 'kategoricn' => $kategoricn,
				 'kategoride' => $kategoride,
				 'kategorien' => $kategorien,
				 'kategories' => $kategories,
				 'kategorifr' => $kategorifr,
				 'kategoript' => $kategoript,
				 'kategoriru' => $kategoriru,
				 'kategoritr' => $kategoritr,
            ));
   

if ($kategoriekle){
echo "<script>
swal({
  title: '".$dil['basarili']."',
  text: '".$dil['kategorieklendi']."',
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
$grupdili = @$_POST["grupdili"];
$grupekle = $db->insert('gruplar')
            ->set(array(
                 'isim' => $isim,
				 'kategori' => $kategori,
				 'sahibi' => $sahibi == '' ? $bilgiler["id"] : $sahibi,
				 'aciklama' => $aciklama,
				 'onay' => $onay == '' ? "0" : $onay,
				 'link' => substr($link, -22),
				 'uyesayisi' => $uyesayisi,
				 'grupdili' => $grupdili
            ));
   

if ($grupekle){
echo "<script>
swal({
  title: '".$dil['basarili']."',
  text: '".$dil['grupeklendi']."',
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
$grupdili = @$_POST["grupdili"];
$grupduzenle = $db->update('gruplar')
			->where('id', $_GET["id"])
            ->set(array(
                 'isim' => $isim,
				 'kategori' => $kategori,
				 'sahibi' => $sahibi == '' ? $getbilgi["sahibi"] : $sahibi,
				 'aciklama' => $aciklama,
				 'onay' => $onay == '' ? "0" : $onay,
				 'link' => substr($link, -22),
				 'uyesayisi' => $uyesayisi,
				 'grupdili' => $grupdili
            ));
   

if ($grupduzenle){
echo "<script>
swal({
  title: '".$dil['basarili']."',
  text: '".$dil['grupguncellendi']."',
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
$kategoriar = $_POST["kategoriar"];
$kategoriaz = $_POST["kategoriaz"];
$kategoricn = $_POST["kategoricn"];
$kategoride = $_POST["kategoride"];
$kategorien = $_POST["kategorien"];
$kategories = $_POST["kategories"];
$kategorifr = $_POST["kategorifr"];
$kategoript = $_POST["kategoript"];
$kategoriru = $_POST["kategoriru"];
$kategoritr = $_POST["kategoritr"];
$kategoriduzenle = $db->update('kategoriler')
			->where('idsi', $_GET['idsi'])
            ->set(array(
                 'kategoriadi' => $kategoriadi,
				 'seokategori' => $seokategori,
				 'kategoriar' => $kategoriar,
				 'kategoriaz' => $kategoriaz,
				 'kategoricn' => $kategoricn,
				 'kategoride' => $kategoride,
				 'kategorien' => $kategorien,
				 'kategories' => $kategories,
				 'kategorifr' => $kategorifr,
				 'kategoript' => $kategoript,
				 'kategoriru' => $kategoriru,
				 'kategoritr' => $kategoritr,
            ));
   

if ($kategoriduzenle){
echo "<script>
swal({
  title: '".$dil['basarili']."',
  text: '".$dil['kategoriduzenlendi']."',
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
//Hesap Ayarları
if (isset($_POST['hesapayarlari'])){
			function checkspecial($string) {
	if (preg_match('/[^a-zA-Z]/', $string)) {
		return false;
	} else {
		return true;
	}
} 
$hacker = sha1(base64_encode(md5(base64_encode($_POST["sifre"])))); 
$id = $_SESSION['id'];
$kullaniciadi = @$_POST["kullaniciadi"];
$sifre = @substr($hacker, 5, 32);
$ad = @$_POST["ad"];
$soyad = @$_POST["soyad"];
$email = @$_POST["email"];
$yetki = @$_POST['yetki'];
 
 $engellenick = $db->select('uyeler')
 ->where('id', $bilgicek['id'], '!=')
 ->where('kullaniciadi', $_POST["kullaniciadi"])
 ->run(TRUE);
 
  $engellemail = $db->select('uyeler')
 ->where('id', $bilgicek['id'], '!=')
 ->where('email', $_POST["email"])
 ->run(TRUE);
if(checkspecial($kullaniciadi)) {
if(filter_var($email, FILTER_VALIDATE_EMAIL)){
if(strlen($sifre) < 0 || strlen($kullaniciadi) < 6){
	$hatayazdir = '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['altikarakter'].'</div>';
} else if(!empty($_POST["kullaniciadi"] and $_POST["ad"] and $_POST["soyad"] and $_POST["email"])) {
	if($kullaniciadi == $engellenick['kullaniciadi']){
	$hatayazdir = '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['kullanilmisnick'].'</div>';
	} elseif($engellemail['email'] == $email){
	$hatayazdir = '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['kullanilmismail'].'</div>';
	} else {
			
$hesapayarlari = $db->update('uyeler')
            ->where('id', $id)
            ->set(array(
                 'kullaniciadi' => $kullaniciadi,
				 'sifre' => $sifre == '8b85a1a86cab4348cdd27f9367c1fee1' ? $bilgicek["sifre"] : $sifre,
				 'ad' => $ad,
				 'soyad' => $soyad,
				 'email' => $email,
				 'yetki' => $bilgicek["yetki"]
            ));
  

if ($hesapayarlari){
echo "<script>
swal({
  title: '".$dil['basarili']."',
  text: '".$dil['hesapbilgileriguncellendi']."',
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
<meta http-equiv='refresh' content='2;URL=hesap-ayarlari'>";

}
}
} else{ $hatayazdir = '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['bosalan'].'</div>';}
} else {$hatayazdir ='<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['gecerlimail'].'</div>'; }
} else {$hatayazdir ='<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['karakter'].'</div>'; }
}
?>
<?php
//Üye Düzenle
if (isset($_POST['uyeduzenle'])){
	$hacker = sha1(base64_encode(md5(base64_encode($_POST["sifre"]))));
$kullaniciadi = @$_POST["kullaniciadi"];
$sifre=@substr($hacker, 5, 32);
$ad = @$_POST["ad"];
$soyad = @$_POST["soyad"];
$email = @$_POST["email"];
$yetki = @$_POST['yetki'];
$uyeduzenle = $db->update('uyeler')
			->where('id', $_GET["id"])
            ->set(array(
                 'kullaniciadi' => $kullaniciadi,
				 'sifre' => $sifre == '8b85a1a86cab4348cdd27f9367c1fee1' ? $uyeduzen["sifre"] : $sifre,
				 'ad' => $ad,
				 'soyad' => $soyad,
				 'email' => $email,
				 'yetki' => $yetki
            ));
   

if ($uyeduzenle){
echo "<script>
swal({
  title: '".$dil['basarili']."',
  text: '".$dil['uyeduzenlendi']."',
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
<meta http-equiv='refresh' content='2;URL=/uye-duzenle/".$_GET['id']." '>";

}
}
?>
<?php
//Şifre Sıfırla
if (isset($_POST['sifresifirla'])){
	$hacker = sha1(base64_encode(md5(base64_encode($_POST["sifre"]))));
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
$sifre = @substr($hacker, 5, 32);
$token = tokengenerator(255);

if(strlen($_POST['sifre']) < 6) {
	$hatayazdir = '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['yenisifrealti'].'</div>';
} else if($_POST['sifre'] != $_POST['sifret']) {
$hatayazdir = '<div class="alert alert-danger"><strong>'.$dil['hata'].'</strong> '.$dil['uyusmadi'].'</div>';
} else {
$sifresifirla = $db->update('uyeler')
			->where('token', $_GET["token"])
            ->set(array(
				 'sifre' => $sifre,
				 'token' => $token
            ));
   

if ($sifresifirla){
echo "<script>
swal({
  title: '".$dil['basarili']."',
  text: '".$dil['sifreguncellendi']."',
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
<meta http-equiv='refresh' content='2;URL=/giris-yap'>";

}
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