<?php
require '../models/addCommentData.php';

    session_start();
    $commentContent = htmlspecialchars($_POST['commentContent']);

    addComment($commentContent, $_SESSION['username'], $_GET['id']);

    header("Location: " . $_SESSION['currentUrl']);
    exit();