<?php
require_once 'controllerMenuCategorie.php';

/**
 * Fonction qui permet l'affichage du formulaire de la page de création de post
 * @param $erreurTab
 * @param $def_username
 * @param $def_mail
 * @param $def_name
 * @return void
 */
function showCreateCategorie(): void
{
?>

<!DOCTYPE html>
<html lang='fr'>
<head>
<meta charset="UTF-8">
<meta name="titre" content="Créer un post">
<meta name="description" content="Page pour créer un post">
<link rel="icon" href="../public/assets/images/logo.png" />
<link rel="stylesheet" href="../public/assets/styles/computer/style.css">
<title>Créer une Croustégorie</title>
</head>


<body>
<div id="ContenuPage">
    <div id="BoxMilieu">
        <h1 id="FormTitre">Créer une Croustégorie</h1>

                <form action="../models/createCategorie.php" method="post">

                    <input type="text" name="titleContent" placeholder="Label de la croustégorie" required><br>
                    <textarea name="postContent" placeholder="Description de la croustégorie" rows="6" cols="50" required></textarea><br><br>

                    <div id="DivBas">
                        <button id="FormBouton" type="submit" name="action">Créer !</button>
                    </div>

            </form>
    </div>
</div>
</body>
<?php
}
?>
