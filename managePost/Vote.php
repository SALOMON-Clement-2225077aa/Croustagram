<?php require_once '../MVC/config/connectDatabase.php';

    if(isset($_POST['upVote'])){
        // UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = 1;
        // Connexion à la base de donnée
        $connexion = connexion();
        $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = 1');
    }
    if(isset($_POST['downVote'])){
        // UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = 1;
        // Connexion à la base de donnée
        $connexion = connexion();
        $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = 1');
    }