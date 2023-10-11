<?php
require '../models/modelVote.php';
session_start();
if(isset($_SESSION['suid'])) downVote($_GET['id']);
else header('Location:' . $_SESSION['currentUrl']);