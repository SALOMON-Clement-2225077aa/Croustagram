<?php
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    $query = 'DELETE FROM croustapost WHERE id=' . $_GET['id'];
    mysqli_query($dbLink, $query);

    header("Location: ../ComputerView/index.php");
    exit();