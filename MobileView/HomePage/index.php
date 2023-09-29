<script src="script.js"></script>

<?php

    require '../utils.inc.php';
    start_page('Fil d\'actualité');

?>


    <div id="ContenuPage">

        <button id="BoutonCreerPost" onclick="ouvrirPopup()"></button>

        <!-- Ajout du popup -->
        <div id="popup">
            <button id="fermerPopup" onclick="fermerPopup()">X</button>
            <form action="index.php" method="post">
                <input type="text" name="titre" placeholder="Titre du post" required><br>
                <textarea name="contenu" placeholder="Contenu du post" rows="6" cols="50" required></textarea><br><br>
                <input type="submit" value="Créer">
            </form>
        </div>
        <script>fermerPopup();</script>
        

        <?php // Lecture + Affichage des posts de la BD (SELECT * FROM `croustapost`)

        // Connexion à la base de donnée
        $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , "croustagramadd_bdd")
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        // Requête
        $result = mysqli_query($dbLink, 'SELECT * FROM croustapost ORDER BY ptsCrous DESC');

        // Si la requête a marché on affiche les posts
        if ($result) {
            // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
            while ($row = mysqli_fetch_assoc($result)) {
                afficher_post($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id']);
            }
            // Libère la variable
            mysqli_free_result($result);
        }
        else {
            echo 'Erreur dans la requête : ' . mysqli_error($dbLink);
        }
        ?>
    </div>


<?php
    end_page('Fil d\'actualité');
?>
