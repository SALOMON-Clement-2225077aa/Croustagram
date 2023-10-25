<?php
// Adresse du serveur :
//   thecroustagram@alwaysdata.net

$destinataire = $_POST['mail'];
$from = 'thecroustagram@alwaysdata.net';
$sujet = 'Rénitialisation de votre mot de passe';

$headers = 'From: Name <' . $from . '>' . "\n";
$headers .= 'Content-Type: text/plain; charset=utf-8';

$lien = '';

$message = 'Voici le lien de rénitialisation du mot de passe, à ne surtout pas partager : \n' . $lien . '\n';
$message .= 'Ne partagez pas ce lien, il permet de changer le mot de passe de ce compte (' . $_SESSION['username'] . ')';

mail($destinataire, $sujet, $message, $headers);

echo 'On espere ca marche hein';