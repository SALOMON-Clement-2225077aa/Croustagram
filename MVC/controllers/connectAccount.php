<?php
    require_once 'controllerPageConnexion.php';
    require_once  '../config/connectDatabase.php';
    ?>
    <link rel="stylesheet" href="../public/assets/styles/computer/style.css">
<?php

    //On filtre l'input utilisateur
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $dbPassword = NULL;

    //On initialise le tableau des erreurs qu'on remplira en fonction des types d'erreurs qu'on obtient
    $tabErreurs = array();

    //On se connecte à la bdd
    $co = connexion();

    //Rien d'intéressant ;)
    if ($username === 'hitori' and $password === 'gotou') connexion_page(array("bocchi"));
    else
    {
        //On vérifie si c'est une adresse email
        if (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $username))
        {

            // Le client se connecte avec son mail

            // On vérifie si il y a bien un compte dans la bdd
            $query = $co->query('SELECT mdp  FROM croustagrameur WHERE email=\'' . $username . '\'');

            // Traitement des données
            while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
            {
                $dbPassword = $dbRow;
            }
            if ($dbPassword == NULL or $dbPassword['mdp'] == '' or !(password_verify($password, $dbPassword['mdp'])))
            {
                // Si il n'y a pas de compte trouvé correspondant au couple mail/mdp, on ajoute l'erreur dans le tableau des erreurs
                $tabErreurs[] = 'noMatchFoundMail';
            }
            else
            {
                // Sinon, on enregistre l'username dans la session, et on se connecte
                $query = $co->query('SELECT id  FROM croustagrameur WHERE email=\'' . $username . '\'');

                while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
                {
                    $dbId = $dbRow;
                }
                session_start();
                $_SESSION['username'] = $dbId['id'];
                $_SESSION['suid'] = session_id();

                // Actualisation de la dernière connexion
                $today = date('Y-m-d');
                $co->exec('UPDATE croustagrameur SET derniere_connexion =  "' . $today . '" WHERE id=\'' . $username . '\'');
                header('Location: ' . $_SESSION['currentUrl']);

                header('Location: ' . $_SESSION['currentUrl']);
                die();
            }
        }
        else
        {
            // Le client se connecte avec son username

            // On vérifie si il y a bien un compte dans la bdd
            $query = $co->query('SELECT mdp  FROM croustagrameur WHERE id=\'' . $username . '\'');

            while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
            {
                $dbPassword = $dbRow;
            }
            if ($dbPassword == NULL or $dbPassword['mdp'] == '' or !(password_verify($password, $dbPassword['mdp'])))
            {
                // Si le couple mdp/username n'existe pas, on ajt une erreur au tableau
                $tabErreurs[] = 'noMatchFoundUsername';
            }
            else
            {
                // Sinon, on se connecte et on enregistre l'username dans la session
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['suid'] = session_id();

                // Actualisation de la dernière connexion
                $today = date('Y-m-d');
                $co->exec('UPDATE croustagrameur SET derniere_connexion =  "' . $today . '" WHERE id=\'' . $username . '\'');
                header('Location: ../views/viewCompte.php?id=' . $_SESSION['username']);
                die();
            }
        }
        if (count($tabErreurs) !== 0)
        {
            // Si on a des erreurs, on se redirige vers la page de connexion avec le teableau d'erreurs
            session_start();
            $_SESSION['tabErreurs'] = $tabErreurs;
            header('Location:../views/viewConnexionPage.php');
            die();
        }
    }