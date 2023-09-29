<?php

require '../utils.inc.php';

start_page('Leaderboard');

?>

    <div id="ContenuPage">

        <?php // Lecture + Affichage des utilisateurs de la BD (SELECT * FROM `croustagrameur`)

        // Connexion à la base de donnée
        $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , "croustagramadd_bdd")
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        // Requête
        $result = mysqli_query($dbLink, 'SELECT * FROM croustagrameur ORDER BY ptsCrous DESC');

        // Si la requête a marché on affiche les users
        if ($result) {
            // afficher_user($pseudo, $img, $date_creation, $date_connexion, $ptsCrous):
            while ($row = mysqli_fetch_assoc($result)) {
                afficher_user($row['pseudo'], $row['img'], $row['creation_compte'], $row['derniere_connexion'], $row['ptsCrous']);
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

end_page('Leaderboard');

?>