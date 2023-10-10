<?php
function showPtsCrous(){

    getPtsCrousData($_SESSION['username']);

    $row = $data->fetch(PDO::FETCH_ASSOC);

    return $row['ptsCrous'];
}
