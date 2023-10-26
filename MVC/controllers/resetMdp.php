<?php
$mdp = htmlspecialchars($_POST['mdp']);
$verifMdp = htmlspecialchars($_POST['verifMdp']);
$accountName = $_POST['accountName'];

echo $mdp . $verifMdp . $accountName;