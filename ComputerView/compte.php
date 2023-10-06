<?php
require 'utils.inc.php';
?>
<head>
    <link rel="stylesheet" href="../MVC/public/assets/styles/style.css">
</head>
<?php
$accountName = $_GET['id'];

// Lecture + Affichage des posts de la BD (SELECT * FROM `croustapost`)

// Connexion à la base de donnée
$dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
mysqli_select_db($dbLink , "croustagramadd_bdd")
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

// Requête
$recherche = 'SELECT * FROM croustapost WHERE croustagrameur_id="' . $accountName . '" ORDER BY ptsCrous DESC';
$result = mysqli_query($dbLink, $recherche);

// Si la requête a marché on affiche les posts
if ($result) {
    ?>
    <section id="posts">
        <article class="post">
    <?php
    // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
    while ($row = mysqli_fetch_assoc($result)) {

        // Requête COMMENTAIRES
        $req = 'SELECT COUNT(*) FROM croustacomm WHERE croustapost_id = ' . $row['id'];
        $nb_comm_result = mysqli_fetch_assoc(mysqli_query($dbLink, $req));
        $nb_comm = (int)$nb_comm_result['COUNT(*)']; // Convert to integer

        afficher_post($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);
    }
    // Libère la variable
    mysqli_free_result($result);
}
