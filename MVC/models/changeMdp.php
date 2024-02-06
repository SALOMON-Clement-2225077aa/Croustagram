<?php
$mdp = htmlspecialchars($_POST['mdp']);
$verifMdp = htmlspecialchars($_POST['verifMdp']);
$accountName = $_POST['accountName'];

require_once '../config/connectDatabase.php';

$connexion = connexion();

if ($mdp!==$verifMdp){
    // Si les deux mot de passe ne correspondent pas, on revient en arrière
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else{
    // Sinon on update le mdp
    $query = 'UPDATE croustagrameur SET mdp="' . password_hash($mdp, PASSWORD_DEFAULT) .'" WHERE id="' . $accountName . '"';

    // Traitement des erreurs
    if (!($dbResult = $connexion->exec($query))) {
        echo '<strong>Erreur dans requête</strong><br>';
        // Affiche le type d'erreur.
        echo '<strong>Erreur : ' . $connexion->errorInfo() . '</strong><br>';
        // Affiche la requête envoyée.
        echo '<strong>Requête : ' . $query . '</strong><br>';
        exit();
    }
    // Si pas d'erreur on revient au menu principal
    else{
        header('Location: ../views/viewMainPage.php');
    }
}