<?php
require "../../connexionCompte/utils.connectaccount.php";
require "../utils.inc.php";
require_once "../../MVC/config/connectDatabase.php";

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$dbPassword = NULL;

$tabErreurs = array();

if ($username === 'hitori' and $password === 'gotou') connexion_page(array("bocchi"));
else
{
    $connexion = connexion();

    if (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $username))
    {
        // Le client se connecte avec son mail

        $query = $connexion->query('SELECT mdp  FROM croustagrameur WHERE email=\'' . $username . '\'');

        while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
        {
            $dbPassword = $dbRow;
        }
        if (!(password_verify($password, $dbPassword['mdp'])))
        {
            $tabErreurs[] = 'noMatchFoundMail';
        }
        else
        {
            $query = $connexion->query('SELECT id  FROM croustagrameur WHERE email=\'' . $username . '\'');

            while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
            {
                $dbId = $dbRow;
            }
            session_start();
            $_SESSION['username'] = $dbId['id'];
            $_SESSION['suid'] = session_id();
            header('Location: ../HomePage/index.php');
        }
    }
    else
    {
        // Le client se connecte avec son username

        $query = $connexion->query('SELECT mdp  FROM croustagrameur WHERE id=\'' . $username . '\'');

        while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
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
            $connexion->exec('UPDATE croustagrameur SET derniere_connexion =  "' . $today . '" WHERE id=\'' . $username . '\'');

            // Actualisation de la dernière connexion
            $today = date('Y-m-d');
            $connexion->exec('UPDATE croustagrameur SET derniere_connexion =  "' . $today . '" WHERE id=\'' . $username . '\'');

            //UPDATE `croustagrameur` SET `derniere_connexion` = '2023-09-29' WHERE `croustagrameur`.`id` = 'bob2sud';

            header('Location: ../HomePage/index.php');
            exit();
        }
    }
    if (count($tabErreurs) !== 0)
    {
        start_page('Connexion');

        connexion_page($tabErreurs);

        end_page('Connexion');
    }
}
