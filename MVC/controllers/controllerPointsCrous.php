<?php

require_once '../models/modelPtsCrous.php';

/**
 * Renvoie le nombre de point crous de l'utilisateur connecté à la session actuelle
 * @return void
 */
function showPtsCrous(){

    $data = getPtsCrousData($_SESSION['username']);

    $row = $data->fetch(PDO::FETCH_ASSOC);

    return $row['ptsCrous'];
}
