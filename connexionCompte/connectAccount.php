<?php
    require 'utils.connectaccount.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    if (!(preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $username)))
    {
        // Le client se connecte avec son username

        $query = 'SELECT mdp  FROM croustagrameur WHERE id=\'' . $username . '\'';
        $dbResult = mysqli_query($dbLink, $query);

        while($dbRow = mysqli_fetch_assoc($dbResult))
        {
            $dbPassword = $dbRow;
        }
        if (!(password_verify($password, $dbPassword['mdp'])))
        {
            connexion_page();
        }
        else
        {
            echo '<label>C\'est bon</label>';
        }

    }
    else
    {
        // Le client se connecte avec son mail


    }