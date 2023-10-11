<?php
require_once '../MVC/config/connectDatabase.php';

    $connexion = connexion();

    $verifData = $connexion->query('SELECT croustagrameur_id FROM croustapost WHERE id=' . $_GET['commId']);
    $verif = $verifData->fetch(PDO::FETCH_ASSOC);

    if($verif['croustagrameur_id']===$_SESSION['username']) $connexion->exec('DELETE FROM croustacomm WHERE id=' . $_GET['commId']);

    header("Location: pagePost.php?id=" . $_GET['postId']);
    exit();