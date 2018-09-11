<?php
require_once "panel/BasicDB.php";
require_once "panel/baglan.php";
$sitebilgi = $db->select('site')
					->run(TRUE);
session_Start();
include "lang.php";
if(@$_SESSION["giris"] == true){
	header("Location: /ana-sayfa");
    die("Burada olmaman gerekirdi!");
}
$kullanici = @$_SESSION['id'];
$kullanicia = @$_SESSION['kullaniciadi'];
$bilgicek = $db->select('uyeler')
			->where('id', $kullanici)
			->or_where('kullaniciadi', $kullanicia)
			->run(TRUE);
			require_once "panel/fonksiyon.php";
				require("panel/class.phpmailer.php");
?>
<?php
$gittiMesaji = " ";
if (isset($_POST["sifremiunuttum"])) {
	$postmail = $_POST['email'];
	$mailuye = $db->select('uyeler')
				->where('email', $postmail)
				->run(TRUE);
    $adi = $mailuye['ad'];
	$soyadi	= $mailuye['soyad'];
	$emaili	= $mailuye['email'];
	$tokeni	= $mailuye['token'];
	$kullaniciad	= $mailuye['kullaniciadi'];
   $mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = 'smtp.yandex.com';
							$mail->Port = 587;
							$mail->SMTPSecure = 'tls';
							$mail->SMTPAuth = true;
							$mail->Username = 'no-reply.wpgrup@yandex.com.tr';
							$mail->Password = 'be483110';
$mail->SetFrom($mail->Username, 'Wpgrup.com');
$mail->AddAddress($emaili, $adi);
$mail->CharSet = 'UTF-8';
$mail->Subject = 'Wpgrup.com - '.$dil['sifremiunuttum'].'';
$content = '<div style="margin:0;padding:0;background:#f4f4f4"><div class="adM">
        </div><table cellpadding="10" cellspacing="0" border="0" width="100%" style="width:0 auto">
            <tbody>
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" width="680" style="border:0;width:0 auto;max-width:680px">
                            <tbody>
                                <tr>
                                </tr>
                                <tr>
                                    
                                    <td style="padding:15px 0 20px 0;background-color:#ffffff;border:2px solid #e8e8e8;border-bottom:2px solid #ff6c2c">
                                        <table width="680" border="0" cellpadding="0" cellspacing="0" style="background:#ffffff;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif">
                                            <tbody>
                                                <tr>
                                                    <td width="15">
                                                    </td>
                                                    <td width="650">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        



<div id="m_3791205745898055917manual_settings_area" class="m_3791205745898055917section">
        <h2 id="m_3791205745898055917hdrManualSettings">Wpgrup.com '.$dil['sifremiunuttum'].'</h2>
        
        <div class="m_3791205745898055917row">
         <div class="m_3791205745898055917col-md-6">
          <div id="m_3791205745898055917ssl_settings_area" style="background-color:#fff;border:1px solid transparent;border-radius:4px;margin-bottom:20px;border-color:#428bca" class="m_3791205745898055917preferred-selection m_3791205745898055917panel m_3791205745898055917panel-primary">
               <div style="border-top-left-radius:3px;border-top-right-radius:3px;padding:10px 15px;background-color:#428bca;border-color:#428bca;color:#fff" class="m_3791205745898055917panel-heading">'.$dil['hesapbilgileriniz'].'
              </div>
              <table class="m_3791205745898055917table m_3791205745898055917manual_settings_table" style="border-collapse:collapse;border-spacing:0;margin-bottom:0;width:100%;background-color:transparent;max-width:100%">
                  <tbody><tr>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917lblSSLSettingsAreaUsername">'.$dil['isim'].':</td>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917valSSLSettingsAreaUsername" class="m_3791205745898055917data">'.$adi.'</td>
                  </tr>
                  <tr>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917lblSettingsAreaPassword">'.$dil['soyisim'].':</td>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917valSettingsAreaPassword" class="m_3791205745898055917escape-note"> '.$soyadi.'</td>
                  </tr>
                  <tr>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917lblSettingsAreaIncomingServer">'.$dil['eposta'].':</td>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917valSettingsAreaIncomingServer" class="m_3791205745898055917data">'.$emaili.'
                      </td>
                  </tr>
                  
                  <tr>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917lblSettingsAreaOutgoingServer">'.$dil['kullaniciadi'].':</td>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917valSettingsAreaOutGoingServer" class="m_3791205745898055917data">'.$kullaniciad.'
                        
                      </td>
                  </tr>
                  <tr>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917lblSettingsAreaOutgoingServer">'.$dil['sifre'].':</td>
                      <td style="border-top:1px solid #ddd;padding:8px" id="m_3791205745898055917valSettingsAreaOutGoingServer" class="m_3791205745898055917data"><a href="http://wpgrup.com/sifre-guncelle/'.$tokeni.'">'.$dil['burayatikla'].'</a>
                        
                      </td>
                  </tr>
              </tbody></table>
          </div>
         </div>

      </div>
    </div>


<p>
    '.$dil['yanitlama'].'
</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                    <td width="15">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top:10px">
                                        <p style="font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:12px;color:#666666;padding:0;margin:0">'.$dil['telifhakki'].'©&nbsp;2017 Wpgrup.com</p><p>
                                    
                                    </p><p></p></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table><div class="yj6qo"></div><div class="adL">
    </div></div>';
$mail->MsgHTML($content);
if($mail->Send()) {
    $gonderildi = '<div class="alert alert-success">'.$dil['sayin'].' '.$adi.', '.$dil['sifreniz'].' '.$emaili.' '.$dil['adresinegonderildi'].'</div>';
} else {
    // bir sorun var, sorunu ekrana bastıralım
	//echo $mail->ErrorInfo;
    $gonderildi = '<div class="alert alert-danger">'.$dil['mailyok'].'</div>';
}
}
?>
<html>
<head> 
		<title><?=$dil['sifremiunuttum']?> | <?php echo $sitebilgi["baslik"];?></title>
		<?php include "pages/head.php"; ?>
</head>
<body>
<?php include "pages/header.php"; ?>
<div class="col-lg-7 col-md-offset-1">
<div class="panel panel-primary">
 <div class="panel-heading"><?=$dil['sifremiunuttum']?></div>
 <div class="panel-body">
 <form action="" method="post">
	<div class="row">
		<div class="col-md-2"></div>
					<div class="col-md-8">
					<div class="col-md-12">
					<?php echo @$gonderildi; ?>
					<div class="col-md-12">
					<div class="form-group">
					<label><?=$dil['epostaadresiniz']?></label>
					<input type="text" class="form-control" placeholder="<?=$dil['emailgir']?>" name="email" required>
		</div>
	</div>
	</div> 
			 <div class="col-md-12">
										<div class="form-group">
										<label><font color="#FFF">Kaydet</font></label>
											<button type="submit" name="sifremiunuttum" class="btn btn-primary btn-block"><?=$dil['gonder']?></button>
										</div>
									</div>
</div></div></form>
</div>
</div>
</div>
<?php include "pages/sidebar.php"; ?>

</body>
</html>
