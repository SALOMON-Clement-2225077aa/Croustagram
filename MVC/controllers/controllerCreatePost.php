<?php
require_once 'controllerMenuCategorie.php';

/**
 * @param $erreurTab
 * @param $def_username
 * @param $def_mail
 * @param $def_name
 * @return void
 * Fonction qui permet l'affichage du formulaire de la page de création de post
 */
function showCreatePostPage($erreurTab = array(), $def_username = NULL, $def_mail = NULL, $def_name = NULL): void
{
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
?>

<?php if (!$isMob) { ?>
    <!DOCTYPE html>
    <html lang='fr'>
    <head>
    <meta charset="UTF-8">
    <meta name="titre" content="Créer un post">
    <meta name="description" content="Page pour créer un post">
    <link rel="icon" href="../public/assets/images/logo.png" />
    <link rel="stylesheet" href="../public/assets/styles/computer/style.css">
    <title>Créer un Croustapost</title>
</head>
<?php } ?>


<body>
<div id="ContenuPage">
    <div id="BoxMilieu">
        <h1 id="FormTitre">Exprimez-vous !</h1>

                <form action="../models/createPost.php" method="post">


                    <input type="text" name="titleContent" placeholder="Titre du post" required><br>
                    <textarea name="postContent" placeholder="Contenu du post" rows="6" cols="50" required></textarea><br><br>

                    <p> Sélectionner des catégories (facultatif) : </p>
                    <select name="Cat1" id="cat1-select">
                        <option value="0">Aucune</option>
                        <?php selectCategorie(); ?>
                    </select>
                    <select name="Cat2" id="cat2-select">
                        <option value="0">Aucune</option>
                        <?php selectCategorie(); ?>
                    </select>
                    <select name="Cat3" id="cat3-select">
                        <option value="0">Aucune</option>
                        <?php selectCategorie(); ?>
                    </select>
                    <br><br><br>

                    <div id="DivBas">
                        <button id="FormBouton" type="submit" name="action">Poster !</button>
                    </div>

            </form>
    </div>
</div>
</body>
<?php
}
?>
