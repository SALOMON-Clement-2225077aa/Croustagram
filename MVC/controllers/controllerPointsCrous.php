<?php

require_once '../models/modelPtsCrous.php';
function showPtsCrous(){

    $data = getPtsCrousData($_SESSION['username']);

    $row = $data->fetch(PDO::FETCH_ASSOC);

    return $row['ptsCrous'];
}
