<?php

$sifresi = "Zxcdsaqwe123_";

$hacker = sha1(base64_encode(md5(base64_encode($sifresi))));
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
echo @substr($hacker, 5, 32);

echo '<br />';



?>