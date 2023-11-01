<?php

require_once '../models/modelPtsCrous.php';

/**
 * @return void
 * Renvoie le nombre de point crous de l'utilisateur connecté à la session actuelle
 */
function showPtsCrous(){

    $data = getPtsCrousData($_SESSION['username']);

    $row = $data->fetch(PDO::FETCH_ASSOC);

    return $row['ptsCrous'];
}
