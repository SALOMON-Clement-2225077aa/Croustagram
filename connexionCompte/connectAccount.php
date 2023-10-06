<?php
    require 'utils.connectaccount.php';
    require_once  '../MVC/config/connectDatabase.php';

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $dbPassword = NULL;

    $tabErreurs = array();

    if ($username === 'hitori' and $password === 'gotou') connexion_page(array("bocchi"));
    else
    {
        $co = connexion();

        if (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $username))
        {
            // Le client se connecte avec son mail

            $query = $co->query('SELECT mdp  FROM croustagrameur WHERE email=\'' . $username . '\'');

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
                $query = $co->query('SELECT id  FROM croustagrameur WHERE email=\'' . $username . '\'');

                while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
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

            $query = $co->query('SELECT mdp  FROM croustagrameur WHERE id=\'' . $username . '\'');

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

                //UPDATE `croustagrameur` SET `derniere_connexion` = '2023-09-29' WHERE `croustagrameur`.`id` = 'bob2sud';

                header('Location: ../index.php');
                exit();
            }
        }
        if (count($tabErreurs) !== 0)
        {
            connexion_page($tabErreurs);
        }
    }
