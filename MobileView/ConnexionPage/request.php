<?php
require "../../connexionCompte/utils.connectaccount.php";
require "../utils.inc.php";

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$dbPassword = NULL;

$tabErreurs = array();

if ($username === 'hitori' and $password === 'gotou') connexion_page(array("bocchi"));
else
{
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    if (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $username))
    {
        // Le client se connecte avec son mail

        $query = 'SELECT mdp  FROM croustagrameur WHERE email=\'' . $username . '\'';
        $dbResult = mysqli_query($dbLink, $query);

        while($dbRow = mysqli_fetch_assoc($dbResult))
        {
            $dbPassword = $dbRow;
        }
        if (!(password_verify($password, $dbPassword['mdp'])))
        {
            $tabErreurs[] = 'noMatchFoundMail';
        }
        else
        {
            $query = 'SELECT id  FROM croustagrameur WHERE email=\'' . $username . '\'';
            $dbResult = mysqli_query($dbLink, $query);

            while($dbRow = mysqli_fetch_assoc($dbResult))
            {
                $dbId = $dbRow;
            }
            session_start();
            $_SESSION['username'] = $dbId['id'];
            $_SESSION['suid'] = session_id();
            header('Location: ../index.php');
        }
    }
    else
    {
        // Le client se connecte avec son username

        $query = 'SELECT mdp  FROM croustagrameur WHERE id=\'' . $username . '\'';
        $dbResult = mysqli_query($dbLink, $query);

        while($dbRow = mysqli_fetch_assoc($dbResult))
        {
            $dbPassword = $dbRow;
        }
        if ($dbPassword == NULL or $dbPassword['mdp'] == '' or !(password_verify($password, $dbPassword['mdp'])))
        {
            $tabErreurs[] = 'noMatchFoundUsername';
        }
        else
        {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['suid'] = session_id();

            // Actualisation de la dernière connexion
            $today = date('Y-m-d');
            $query = 'UPDATE croustagrameur SET derniere_connexion =  "' . $today . '" WHERE id=\'' . $username . '\'';
            mysqli_query($dbLink, $query);

            // Actualisation de la dernière connexion
            $today = date('Y-m-d');
            $query = 'UPDATE croustagrameur SET derniere_connexion =  "' . $today . '" WHERE id=\'' . $username . '\'';
            mysqli_query($dbLink, $query);

            //UPDATE `croustagrameur` SET `derniere_connexion` = '2023-09-29' WHERE `croustagrameur`.`id` = 'bob2sud';

            header('Location: ../index.php');
            exit();
        }
    }
    if (count($tabErreurs) !== 0)
    {
        start_page('Connexion');

        connexion_page();

        end_page('Connexion');
    }
}
