<?php
/**
 * Récupère et renvoie le nb de points de l'utilisateur en paramètre
 * @param $id_user = l'id de l'utilisateur
 */
function getPtsCrousData($id_user){
    // Connexion à la base de donnée
    $connexion = connexion();

    // Requête
    $data = $connexion->query('SELECT ptsCrous FROM croustagrameur WHERE id="' . $id_user . '"');

    return $data;
}