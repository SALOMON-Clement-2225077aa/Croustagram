<?php require_once '../MVC/config/connectDatabase.php';

    $connexion = connexion();

    $connexion->exec('DELETE FROM croustacomm WHERE id=' . $_GET['commId']);

    header("Location: pagePost.php?id=" . $_GET['postId']);
    exit();