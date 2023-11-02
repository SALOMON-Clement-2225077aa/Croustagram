<?php

require_once '../config/connectDatabase.php';
require_once '../models/modelAdmin.php';

$connexion = connexion();
session_start();

if($_GET['commId'] != null){
    $verifData = $connexion->query('SELECT croustagrameur_id FROM croustacomm WHERE id=' . $_GET['commId']);
    while($verif = $verifData->fetch(PDO::FETCH_ASSOC)){
        if ($verif['croustagrameur_id'] === $_SESSION['username'] or isAdmin($_SESSION['username'])) {
            $connexion->exec('DELETE FROM croustacomm WHERE id=' . $_GET['commId']);
            header("Location: ../views/viewPost.php?id=" . $_GET['postId']);
            exit();
        }
    }
}
else {
    $verifData = $connexion->query('SELECT croustagrameur_id FROM croustapost WHERE id=' . $_GET['postId']);
    while ($verif = $verifData->fetch(PDO::FETCH_ASSOC)){
        if ($verif['croustagrameur_id'] === $_SESSION['username'] or isAdmin($_SESSION['username'])) {
            $connexion->exec('DELETE FROM croustapost WHERE id=' . $_GET['postId']);
            header("Location: ../views/viewMainPage.php");
            exit();
        }
    }
}
