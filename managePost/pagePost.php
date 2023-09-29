<?php
    require 'post.php';

    // Affichage du poste

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    // Requête
    $result = mysqli_query($dbLink, 'SELECT * FROM croustapost WHERE id = \'' . $_GET['id'] . '\'');

    if($result)
    {
        $row = mysqli_fetch_array($result);
        afficher_unique_post($row['titre'], $row['message'], $row['croustagrammeur_id'], $row['date'], $row['ptsCrous'], $row['categories']);
    }

    // Affichage des commentaires

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    // Requête
    $result = mysqli_query($dbLink, 'SELECT * FROM croustacomm WHERE croustapost_id = \'' . $_GET['id'] . '\'');

    if($result)
    {
        $row = mysqli_fetch_array($result);
        afficher_unique_post($row['titre'], $row['message'], $row['croustagrammeur_id'], $row['date'], $row['ptsCrous'], $row['categories']);
    }