<?php
    session_start();
    $commentContent = htmlspecialchars($_POST['commentContent']);

    $today = date('Y-m-d');

    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    $query = 'INSERT INTO croustacomm (texte, date, croustagrameur_id, croustapost_id, pts_crous) VALUES ("' .  $commentContent . '", "' . $today . '", "' . $_SESSION['username'] . '", "' . $_GET['id'] . '", 0)';

    if (!($dbResult = mysqli_query($dbLink, $query))) {
        echo '<strong>Erreur dans requête</strong><br>';
        // Affiche le type d'erreur.
        echo '<strong>Erreur : ' . mysqli_error($dbLink) . '</strong><br>';
        // Affiche la requête envoyée.
        echo '<strong>Requête : ' . $query . '</strong><br>';
        exit();
    }
    else
    {
        header("Location: pagePost.php?id=" . $_GET['id']);
    }

