<?php
require_once '../models/modelVote.php';
session_start();
if(isset($_SESSION['suid'])) downVotePressed($_GET['id']);
else header('Location:' . $_SESSION['currentUrl']);