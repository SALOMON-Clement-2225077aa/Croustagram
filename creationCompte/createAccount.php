<?php
    require 'utils.createaccount.php';
    $action = $_POST['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $mail = $_POST['mail'];

    $tabErreur = array();

    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));


    if (strlen($password)<8)
    {
        $tabErreur[] = "password";
    }
    if (!ctype_alnum($username))
    {
        $tabErreur[] = "username";
    }
    if (!(preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $mail))){
        $tabErreur[] = "mail";
    }
    if(count($tabErreur) === 0)
    {

        //Ici on mettra la vérification du username déjà pris ou non, puis on créera le compte dans la base de donnée

        echo '<br><strong>Username : ' . $username . '</strong><br><strong>Password : ' . $password . '</strong>';
        if(!(chop($name)==='')) {
            $name = $username;
        }
        echo '<br><strong>Name : ' . $name . '</strong>';

        //Code d'insertion dans la BD

        $today = date('Y-m-d');

        $query = 'INSERT INTO croustagrameur (id, pseudo, email, mdp, img, creation_compte, derniere_connexion, ptsCrous) VALUES ("' . $username . '", "' . $name . '", "' . $mail . '", "' . $password . '", "img2", "' . $today . '", "' . $today . '", 0)';

        if (!($dbResult = mysqli_query($dbLink, $query))) {
            echo 'Erreur dans requête<br >';
            // Affiche le type d'erreur.
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
            // Affiche la requête envoyée.
            echo 'Requête : ' . $query . '<br>';
            exit();
        }
    }
    else
    {
        account_page($tabErreur, $username, $mail);
    }

