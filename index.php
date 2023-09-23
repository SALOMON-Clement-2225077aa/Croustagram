<!-- Import des fonctions -->
<?php require 'utils.inc.php'; ?>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="script.js"></script>

<!-- Contenu de la page -->
<?php
    start_page('Croustagram - Accueil');
?>

<button onclick="ouvrirPost()"> Créer un croustapost </button>

<!-- Ajout du popup -->
<div id="popup">
    <button id="fermerPopup" onclick="fermerPopup()">X</button>
    <form action="index.php" method="post">
        <!-- Ajoutez les champs du formulaire pour créer un post ici -->
        <input type="text" name="titre" placeholder="Titre du post (facultatif)"><br>
        <textarea name="contenu" placeholder="Contenu du post" rows="6" cols="50" required></textarea><br><br>
        <input type="submit" value="Créer">
    </form>
</div>

<!-- Ajout du post -->
<?php
if (strlen($_POST['contenu']) > 0) {
    $date = date("d/m/y H:i")
    ?>
    <br><br><br><br>
    <div id="post">
        <table id="tabPost">
            <tr>
                <th><img src="ressources/profil.png" id="imgProfil">monNomDeProfil</th>
                <th id="titrePost"><?php
					echo '<h1>' . $_POST['titre'] . '</h1>';
					?></th>
                <th><?php
                    echo $date;
                ?></th>
            </tr>
            <tr>
                <th colspan="3"><?php
                    echo '<h2>' . $_POST['contenu'] . '</h2>';
                    ?></th>
            </tr>
            <tr>
                <th>508
                    <img src="ressources/fleche-vers-le-haut.png" id="imgProfil">
                    <img src="ressources/fleche-vers-le-bas.png" id="imgProfil">
                </th>
                <th> #test #fantome #silver </th>
                <th><img src="ressources/commentaire.png" id="imgProfil"></th>
            </tr>
        </table>
    </div>
    <?php
}
?>

<?php
    end_page();
?>
