<?php
require_once '../config/connectDatabase.php';

/**
 * Recupère et renvoie toutes les infos de la base sur les catégories :
 * @return PDOStatement (id, libelle et description)
 */
function getCategories(): PDOStatement
{
    // Connexion à la BdD
    $connexion = connexion();

    // Requête
    $requete = 'SELECT id, libelle, description FROM croustegorie';
    $result = $connexion->query($requete);
    return $result;
}