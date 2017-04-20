<?php
session_start();
$liste = "abcdefghijklmnopqrstuvwxyz123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$code = '';
while(strlen($code) != 5) {
$code .= $liste[rand(0,63)];
}
$_SESSION['code']=$code;
$larg = 60;
$haut =20;
$img = imageCreate($larg, $haut);
$rouge = imageColorAllocate($img,255,0,0);
$noir = imageColorAllocate($img,0,0,0);
$code_police=15;
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Cache-Control: no-store, no-cache, must-revalidate'); 
header('Cache-Control: post-check=0, pre-check=0', false); 
header("Content-type: image/jpeg");
imageString($img, $code_police,($larg-imageFontWidth($code_police)*strlen("".$code.""))/2,0, $code,$noir);
imagejpeg($img,'',65);
imageDestroy($img);
?>
