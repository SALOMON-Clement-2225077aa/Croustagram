<?php
require_once '../models/modelVote.php';

/**
 * Fichier qui upvote le post donné par get quand il est appelé,
 * Puis retourne sur la page qui l'a appelé avec le header.
 */
session_start();
if(isset($_SESSION['suid'])) upVotePressed($_GET['id']);
else header('Location:' . $_SESSION['currentUrl']);