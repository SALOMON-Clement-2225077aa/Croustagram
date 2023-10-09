<script src="script.js"></script>
<link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/homePage.css">

<?php

    require '../utils.inc.php';
    require_once "../../MVC/config/connectDatabase.php";
    start_page('Fil d\'actualité');
    session_start();

?>

    <div id="ContenuPage">

        <?php
            if (isset($_SESSION['username'])) {
        ?>
            <button id="BoutonCreerPost" onclick="ouvrirPopup()"></button>
        <?php
            }
        ?>
        <!-- Ajout du popup -->
        <div id="popup">
            <button id="fermerPopup" onclick="fermerPopup()">X</button>
            <form action="../../managePost/addPost.php" method="post">
                <input type="text" name="titre" placeholder="Titre du post" required><br>
                <textarea name="contenu" placeholder="Contenu du post" rows="6" cols="50" required></textarea><br><br>
                <input type="submit" value="Créer">
            </form>
        </div>
        <script>fermerPopup();</script>
        

        <?php // Lecture + Affichage des posts de la BD (SELECT * FROM `croustapost`)

        // Connexion à la base de donnée
        $connexion = connexion();

        // Requête
        $result = $connexion->query('SELECT * FROM croustapost ORDER BY ptsCrous DESC');

        // Si la requête a marché on affiche les posts
        if ($result) {
            // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
            while ($row =  $result->fetch(PDO::FETCH_ASSOC)) {

                // Requête COMMENTAIRES
                $nb_comm = (int)$connexion->query('SELECT COUNT(*) FROM croustacomm WHERE croustapost_id = ' . $row['id'])->fetch(PDO::FETCH_ASSOC)['COUNT(*)']; // Convert to integer

                afficher_post($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);
            }
            // Libère la variable
            $result->closeCursor();
        }
        else {
            echo 'Erreur dans la requête : ' . $connexion->errorInfo();
        }
        ?>
        <br>
        <br>
    </div>

<?php
    end_page('Fil d\'actualité');
?>