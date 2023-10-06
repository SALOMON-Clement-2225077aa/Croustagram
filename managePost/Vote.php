<?php

    if(isset($_POST['upVote'])){
        // UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = 1;
        // Connexion à la base de donnée
        $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , "croustagramadd_bdd")
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        $result = mysqli_query($dbLink, 'UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = 1');
    }
    if(isset($_POST['downVote'])){
        // UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = 1;
        // Connexion à la base de donnée
        $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , "croustagramadd_bdd")
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        $result = mysqli_query($dbLink, 'UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = 1');
    }

?>