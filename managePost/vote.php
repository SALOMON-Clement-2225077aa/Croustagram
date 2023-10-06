<?php
function upVote($post_ID) : void
{
    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $result = mysqli_query($dbLink, 'UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = ' . $post_ID);
}
function downVote($post_ID) : void
{
    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $result = mysqli_query($dbLink, 'UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = ' . $post_ID);
}

?>
