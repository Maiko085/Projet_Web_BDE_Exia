<?php
session_start();
if(!isset($_SESSION['code']) OR strlen($_SESSION['code']) !=5) exit("Erreur !");
if($_SESSION['code'] != $_POST['verif']) exit("Erreur les valeurs sont différentes !");
$exp = $_POST['mail'];
$objet = stripslashes($_POST['objet']);
$msg = stripslashes($_POST['msg']);
$envoi=mail("BDE-Lyon@yopmail.com", $objet, $msg,"From: $exp\r\n"."Reply-To: $exp\r\n")
if($envoi) echo"Le mail a bien été envoyé !";
else echo"L'envoi a échoué, merci de renouveller l'opération !";
session_unset();
session_destroy();
?>
