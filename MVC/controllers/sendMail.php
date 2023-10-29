<?php
// Adresse du serveur :
//   thecroustagram@alwaysdata.net

require_once '../models/modelCompte.php';

// SI VOUS VOULEZ METTRE LA BARRE DE NAVIGATION PAR DESSUS ENLEVEZ LE SESSION START !!!
session_start();
$_SESSION['suid'] = session_id();

$destinataire = $_POST['mail'];

$data = getCompteDataByMail($destinataire);
$row = $data->fetch(PDO::FETCH_ASSOC);

if(!empty($row)){
    $from = 'thecroustagram@alwaysdata.net';
    $sujet = 'Rénitialisation de votre mot de passe';

    $headers = 'From: Croustagram <thecroustagram@alwaysdata.net>' . "\r\n";
    $lien = 'https://thecroustagram.alwaysdata.net/MVC/views/viewResetMdp.php?suid=' . $_SESSION['suid'] . '&accountId=' . $row['id'];

    $message = nl2br('Voici le lien de rénitialisation du mot de passe, à ne surtout pas partager : ' . "\r\n" . $lien );

    mail($destinataire, $sujet, $message, $headers);
}
header('Location: ../views/viewMainPage.php');