<!-- Import des fonctions -->
<?php require 'utils.inc.php'; ?>
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="script.js"></script>

<!-- Contenu de la page -->
<?php
    start_page('Croustagram - Accueil');
    echo '<script>fermerPopup();</script>';
?>;

<button onclick="ouvrirPost()"> Créer un croustapost </button>

<!-- Ajout du popup -->
<div id="popup">
    <button id="fermerPopup" onclick="fermerPopup()">X</button>
    <form action="index.php" method="post">
        <input type="text" name="titre" placeholder="Titre du post (facultatif)"><br>
        <textarea name="contenu" placeholder="Contenu du post" rows="6" cols="50" required></textarea><br><br>
        <input type="submit" value="Créer">
    </form>
</div>

<!-- Ajout du post -->
<?php
if (strlen($_POST['contenu']) > 0) {
    $date = date("d/m/y H:i");

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    //Code d'insertion dans la BD
    $today = date('Y/m/d');
    $query = 'INSERT INTO croustapost (croustagrameur_id, titre, message, date, categories) VALUES ("ClementRKG", "' . $_POST["titre"] . '", "' . $_POST["contenu"] . '", "' . $today . '", "aucune")';

    // Gestion d'erreur BD
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
        echo 'Requête : ' . $query . '<br>';
        exit();
    }
    echo '<script>fermerPopup();</script>';
?>

    <!-- Afficher le post --> 
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
    echo '<script>fermerPopup();</script>';
    end_page();
?>
