<!-- Import des fonctions -->
<?php require 'utils.inc.php'; ?>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="script.js"></script>

<!-- Contenu de la page -->
<?php
    start_page('Croustagram - Accueil');
?>

<button onclick="ouvrirPost()"> créer un post </button>
<button onclick="creerCompte()"> créer un compte </button>

<!-- Ajout du popup -->
<div id="popup">
    <button id="fermerPopup" onclick="fermerPost()">X</button>
    <form action="index.php" method="post">
        <!-- Ajoutez les champs du formulaire pour créer un post ici -->
        <input type="text" name="titre" placeholder="Titre du post (facultatif)"><br>
        <textarea name="contenu" placeholder="Contenu du post" rows="6" cols="50" required></textarea><br><br>
        <input type="submit" value="Créer">
    </form>
</div>

<?php
if (strlen($_POST['contenu']) > 0) {

    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink)
    );

    //Code d'insertion dans la BD
    $today = date('Y-m-d');
    $query = 'INSERT INTO croustapost (croustagrameur_id, titre, message, date, categories) VALUES ("Gabriel", "' . $_POST["titre"] . '", "' . $_POST["contenu"] . '", ' . $today . ', "categories")';

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br>';
        echo 'Requête : ' . $query . '<br>';
        exit();
    }

    echo '<div id="post">';
    echo '<h2>' . $_POST['titre'] . '</h2>';
    echo '<h2>' . $_POST['contenu'] . '</h2>';
    echo '</div>';

}
?>


<?php
    end_page();
?>
