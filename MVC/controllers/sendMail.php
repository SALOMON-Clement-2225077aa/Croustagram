<?php
// Adresse du serveur :
//   thecroustagram@alwaysdata.net

require_once '../models/modelCompte.php';

/**
 * Fichier qui envoie par mail un lien de rénitialisation de mot de passe
 * au destinataire donné par post
 */
session_start();
$_SESSION['suid'] = session_id();

$destinataire = $_POST['mail'];

// On prends les données du compte associé à cette adresse email
$data = getCompteDataByMail($destinataire);
$row = $data->fetch(PDO::FETCH_ASSOC);

// Si il y a des données, il y a un comtpe donc on peut envoyer un mail
if(!empty($row)){
    // Exepéditeur
    $from = 'thecroustagram@alwaysdata.net';
    // Objet du mail
    $sujet = 'Rénitialisation de votre mot de passe';

    // Info du mail
    $headers = 'From: Croustagram <thecroustagram@alwaysdata.net>' . "\r\n";

    // Le lien de rénit du mdp
    $lien = 'https://thecroustagram.alwaysdata.net/MVC/views/viewResetMdp.php?suid=' . $_SESSION['suid'] . '&accountId=' . $row['id'];

    // Le message final du mail
    $message = nl2br('Voici le lien de rénitialisation du mot de passe, à ne surtout pas partager : ' . "\r" . $lien );

    // On envoi le mail
    mail($destinataire, $sujet, $message, $headers);
}
header('Location: ../views/viewMainPage.php');