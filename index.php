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

<?php
if (strlen($_POST['contenu']) > 0) {
?>
<br><br><br><br>
<div id="post">
<?php
    echo '<h2>' . $_POST['titre'] . '</h2>';
    echo '<h2>' . $_POST['contenu'] . '</h2>';
?>
</div>
<?php
}
?>
<?php
    end_page();
?>
