<?php require_once '../MVC/config/connectDatabase.php';

$connexion = connexion();

$connexion->exec('DELETE FROM croustapost WHERE id=' . $_GET['id']);

header("Location: ../ComputerView/index.php");
exit();