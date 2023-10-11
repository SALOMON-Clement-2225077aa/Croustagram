<?php
    require_once '../config/connectDatabase.php';

    session_start();

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $passwordMatch = htmlspecialchars($_POST['passwordMatch']);

    $tabErreur = array();

    function page_erreur(){
        global $mail, $username, $tabErreur, $name;
        $_SESSION['createMail'] = $mail;
        $_SESSION['createUsername'] = $username;
        $_SESSION['createTabErreur'] = $tabErreur;
        $_SESSION['createName'] = $name;
        header('Location: ../views/viewCreerCompte.php');
        exit();
    }

    $connexion = connexion();

    if (strlen($password)<8)
    {
        $tabErreur[] = "password";
    }
    elseif ($password !== $passwordMatch)
    {
        $tabErreur[] = "passwordMatch";
    }
    if (!ctype_alnum($username))
    {
        $tabErreur[] = "username";
    }
    elseif (strlen($username) > 20)
    {
        $tabErreur[]  = "usernameLong";
    }
    if (!(preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $mail))){
        $tabErreur[] = "mail";
    }
    if (strlen($name) > 25)
    {
        $tabErreur[] = "nameLong";
    }

    $query = $connexion->query('SELECT id  FROM croustagrameur WHERE id=\'' . $username . '\'');

    while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
    {
        if ($dbRow['id'] != ''){
            $tabErreur[] = "usernamePris";
        }
    }

    if (strlen($mail) > 50)
    {
        $tabErreur[] = "mailLong";
    }
    else
    {
        $query = $connexion->query('SELECT id  FROM croustagrameur WHERE email=\'' . $mail . '\'');

        while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
        {
            if ($dbRow['id'] != ''){
                $tabErreur[] = "mailPris";
            }
        }
    }



    if(count($tabErreur) === 0)
    {

        //Ici on mettra la vérification du username déjà pris ou non, puis on créera le compte dans la base de donnée

        echo '<br><strong>Username : ' . $username . '</strong><br><strong>Password : ' . $password . '</strong>';
        if(chop($name)==='') {
            $name = $username;
        }
        echo '<br><strong>Name : ' . $name . '</strong>';


        //Code d'insertion dans la BD

        //Encodage du mdp
        $password = password_hash($password, PASSWORD_DEFAULT);

        $today = date('Y-m-d');

        $query = 'INSERT INTO croustagrameur (id, pseudo, email, mdp, img, creation_compte, derniere_connexion, ptsCrous) VALUES ("' . $username . '", "' . $name . '", "' . $mail . '", "' . $password . '", "img2", "' . $today . '", "' . $today . '", 0)';

        if (!($dbResult = $connexion->exec($query))) {
            echo '<strong>Erreur dans requête</strong><br>';
            // Affiche le type d'erreur.
            echo '<strong>Erreur : ' . $connexion->errorInfo() . '</strong><br>';
            // Affiche la requête envoyée.
            echo '<strong>Requête : ' . $query . '</strong><br>';
            exit();
        }
        session_unset();
        $_SESSION['username'] = $username;
        $_SESSION['suid'] = session_id();
        header('Location: ../views/viewMainPage.php');
        exit();
    }
    else {
        page_erreur();
    }