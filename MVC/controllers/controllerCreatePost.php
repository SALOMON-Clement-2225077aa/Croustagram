<?php
require_once '../config/connectDatabase.php';

function showCreatePostPage($erreurTab = array(), $def_username = NULL, $def_mail = NULL, $def_name = NULL): void
{
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
?>

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

<body>
<div id="ContenuPage">
    <div id="BoxMilieu">
        <h1 id="FormTitre">Exprimez vous !</h1>
        <?php if ($isMob) { ?>
        <form action="request.php" method="post">
            <?php }
            else { ?>
                <form action="../models/createPost.php" method="post">
            <?php } ?>

                    <input type="text" name="titleContent" placeholder="Titre du post" required><br>
                    <textarea name="postContent" placeholder="Contenu du post" rows="6" cols="50" required></textarea><br><br>

                    <?php // Récupération des catégorie pour menu déroulant de selection

                        // Connexion à la base de donnée
                        $connexion = connexion();

                        // Requête
                        $requete = 'SELECT libelle FROM croustegorie ORDER BY id ASC';
                        $result = $connexion->query($requete);
                        ?>

                    <p> Sélectionner des catégories (facultatif) : </p>
                    <select name="Catégorie 1" id="cat1-select">
                        <option value="">Aucune</option>
                        <?php
                        $numCat = 0;
                        while($row = $result->fetch(PDO::FETCH_ASSOC)){
                            if ($row['libelle'] != 'None') {
                                $numCat += 1;
                                echo '<option value="' . $numCat .'">' . $row['libelle'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <select name="Catégorie 2" id="cat1-select">
                        <option value="">Aucune</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <select name="Catégorie 3" id="cat1-select">
                        <option value="">Aucune</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
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
