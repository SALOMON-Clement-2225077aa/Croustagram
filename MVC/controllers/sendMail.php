<?php
// Adresse du serveur :
//   thecroustagram@alwaysdata.net

session_start();

$destinataire = $_POST['mail'];
$from = 'thecroustagram@alwaysdata.net';
$sujet = 'Rénitialisation de votre mot de passe';

$headers = 'From: Name <' . $from . '>' . "\n";
$headers .= 'Content-Type: text/plain; charset=utf-8';

$lien = '';

$message = nl2br('Voici le lien de rénitialisation du mot de passe, à ne surtout pas partager : ' . $lien . '\n');
$message .= 'Ne partagez pas ce lien, il permet de changer le mot de passe du compte lié à cette adresse E-Mail (' . $_SESSION['username'] . ')';

mail($destinataire, $sujet, $message, $headers);

echo 'On espere ca marche hein';