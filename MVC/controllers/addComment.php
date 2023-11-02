<?php

//On import le model pour ajt les comm dans la bdd
require '../models/addCommentData.php';

    // On met le contenu du commentaire dans $commentContent
    session_start();
    $commentContent = htmlspecialchars($_POST['commentContent']);

    // On ajoute le comm dans la bdd
    addComment($commentContent, $_SESSION['username'], $_GET['id']);

    // On repart sur la page précédente
    header("Location: " . $_SESSION['currentUrl']);
    exit();