<?php

require_once '../config/connectDatabase.php';

$today = date('Y-m-d');

$connexion = connexion();

/**
 * Fonction qui ajt un commentaire dans la bdd
 * @param $contenu = contenu du commentaire
 * @param $auteur = auteur du commentaire
 * @param $idPost = id du post commenté
 * @return void
 */

function addComment($contenu, $auteur, $idPost){
    global $today, $connexion;

    if($contenu!=='' and $contenu!==null and $contenu!==' '){

        // On écrit la requête
        $query = 'INSERT INTO croustacomm (texte, date, croustagrameur_id, croustapost_id) VALUES ("' .  $contenu . '", "' . $today . '", "' . $auteur . '", "' . $idPost . '")';

        // Traitement des erreurs
        if (!($dbResult = $connexion->exec($query))) {
            echo '<strong>Erreur dans requête</strong><br>';
            // Affiche le type d'erreur.
            echo '<strong>Erreur : ' . $connexion->errorInfo() . '</strong><br>';
            // Affiche la requête envoyée.
            echo '<strong>Requête : ' . $query . '</strong><br>';
            exit();
        }
    }
}