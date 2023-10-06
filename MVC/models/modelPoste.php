<?php

// Connexion à la base de donnée
$dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
mysqli_select_db($dbLink , "croustagramadd_bdd")
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

function getOnePostData($id){
    global $dbLink;


    $recherche = 'SELECT * FROM croustapost ORDER BY ptsCrous DESC';
    $result = mysqli_query($dbLink, $recherche);


    if ($result) {
        return $result;
    }
    else
    {
        echo 'Erreur dans la requête : ' . mysqli_error($dbLink);
    }

}



function getNbCommentaireData($id){
    global $dbLink;
    // Requête COMMENTAIRES
    $req = 'SELECT COUNT(*) FROM croustacomm WHERE croustapost_id = ' . $id;
    $nb_comm_result = mysqli_fetch_assoc(mysqli_query($dbLink, $req));

    if ($nb_comm_result){
        return $nb_comm_result;
    }
}
