<?php
session_start();
if (!isset($_GET['suid']) or !isset($_GET['accountId']) or ($_GET['suid'] !== $_SESSION['suid'])) header('Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley');

echo '<form action="../controllers/resetMdp.php" method="post">
<label>Entrez votre mot de passe</label>
<input name="mdp" type="password"  placeholder="Mot de passe">
<label>Vérifiez votre mot de passe</label>
<input name="verifMdp" type="password"  placeholder="Vérifier le mot de passe">
<button type="submit" name="accountName" value="' . $_GET['accountId'] . '">Changer le mot de passe</button>
</form>';