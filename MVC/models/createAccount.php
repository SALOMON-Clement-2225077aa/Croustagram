<?php
    require_once '../config/connectDatabase.php';
    require_once '../models/uploadProfilePicture.php';

    session_start();

    // On filtre l'input utilisateur
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $passwordMatch = htmlspecialchars($_POST['passwordMatch']);

    // Upload l'image sur imgur et stock le lien de l'image upload dans la variable
    // Si erreur ou pas d'image renvoie 'no_img'
    $link_img = upload_img();

    $tabErreur = array();

    // On renvoi sur la page d'erreur en cas d'erreurs
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

    // On procède aux vérifiacations de toutes les entrées pour repsecter les règles de la bdd
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

    // On cherche des comptes déjà utilisés
    $query = $connexion->query('SELECT id  FROM croustagrameur WHERE id=\'' . $username . '\'');

    while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
    {
        // On vérifie que le nom d'utilisateur ne soit pas pris
        if ($dbRow['id'] != ''){
            $tabErreur[] = "usernamePris";
        }
    }

    // On vérifie que le mail ne soit pas trop long
    if (strlen($mail) > 50)
    {
        $tabErreur[] = "mailLong";
    }
    else
    {
        $query = $connexion->query('SELECT id  FROM croustagrameur WHERE email=\'' . $mail . '\'');

        while($dbRow = $query->fetch(PDO::FETCH_ASSOC))
        {
            // On vérifie que le mail ne soit pas pris
            if ($dbRow['id'] != ''){
                $tabErreur[] = "mailPris";
            }
        }
    }
    // Si il n'y a aucune erreur, on peut créer le compte
    if(count($tabErreur) === 0)
    {

        //Encodage du mdp
        $password = password_hash($password, PASSWORD_DEFAULT);

        // On prends la date d'aujrdhui
        $today = date('Y-m-d');

        // On ajoute le compte
        $query = 'INSERT INTO croustagrameur (id, pseudo, email, mdp, img, creation_compte, derniere_connexion, ptsCrous) VALUES ("' . $username . '", "' . $name . '", "' . $mail . '", "' . $password . '", "' . $link_img . '", "' . $today . '", "' . $today . '", 0)';

        if (!($dbResult = $connexion->exec($query))) {
            echo '<strong>Erreur dans requête</strong><br>';
            // Affiche le type d'erreur.
            echo '<strong>Erreur : ' . $connexion->errorInfo() . '</strong><br>';
            // Affiche la requête envoyée.
            echo '<strong>Requête : ' . $query . '</strong><br>';
            exit();
        }

        $url = "https://discord.com/api/webhooks/1204350532156919818/h7M17sqyxQPke9i6OOpaEnMkso9-HlGkw1-Z2JE8dZQOSGspoS_32b8m6jeV6rowHijK";

        $headers = [ 'Content-Type: application/json; charset=utf-8' ];
        $POST = [ 'username' => 'CroustaBot', 'content' =>  '||@everyone||' . "\r\n" . 'Bienvenue à ' . $name . ' sur Croustagram !' . "\r\n" . 'https://thecroustagram.alwaysdata.net/MVC/views/viewCompte.php?id=' . $username];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response = curl_exec($ch);
        error_log($response);

        // On enleve les valeurs de la session pour en ajouter des nouvelles
        session_unset();
        $_SESSION['username'] = $username;
        $_SESSION['suid'] = session_id();
        header('Location: ../views/viewCompte.php?id=' . $_SESSION['username']);
        exit();
    }
    else {
        page_erreur();
    }