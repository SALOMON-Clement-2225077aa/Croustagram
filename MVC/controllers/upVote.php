<?php
require '../models/modelVote.php';

session_start();
if(isset($_SESSION['suid'])) upVotePressed($_GET['id']);
else header('Location:' . $_SESSION['currentUrl']);