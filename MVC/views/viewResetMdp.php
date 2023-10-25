<?php
$accountName = $_GET['accountId'];
$suid = $_GET['suid'];
session_start();
if ($suid !== $_SESSION['suid']) header('Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley');

echo '<form action="../controllers/resetMdp.php" method="post">
<input name="mdp" type="password">
<input name="verifMdp" type="password">
<button type="submit" name="accountName" value="' . $accountName . '">
</form>';
