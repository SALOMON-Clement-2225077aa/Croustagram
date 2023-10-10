<?php
function getPtsCrousData($id){
    // Connexion à la base de donnée
    $connexion = connexion();

    // Requête
    $data = $connexion->query('SELECT ptsCrous FROM croustagrameur where id =' . $id);
}