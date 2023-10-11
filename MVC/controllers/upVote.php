<?php
require '../models/modelVote.php';

session_start();
if(isset($_SESSION['suid'])) upVote($_GET['id']);
else header('Location:' . $_SESSION['currentUrl']);