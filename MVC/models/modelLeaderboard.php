<?php

function getLeaderboardData(){
    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    // Requête
    $result = mysqli_query($dbLink, 'SELECT * FROM croustagrameur ORDER BY ptsCrous DESC');

    // Si la requête a marché on affiche les users
    if ($result) {
        return $result;
    }
    else {
        echo 'Erreur dans la requête : ' . mysqli_error($dbLink);
    }
}