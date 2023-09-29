<?php
    require 'post.php';
    session_start();

    // Affichage du poste

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    // Requête
    $result = mysqli_query($dbLink, 'SELECT * FROM croustapost WHERE id = \'' . $_GET['id'] . '\'');

    if($result)
    {
        $row = mysqli_fetch_array($result);
        if(isset($row['categories']))
        {
            afficher_unique_post($row['titre'], $row['message'], $row['croustagrameur_id'], $row['date'], $row['ptsCrous'], $row['categories']);
        }
        else
        {
            afficher_unique_post($row['titre'], $row['message'], $row['croustagrameur_id'], $row['date'], $row['ptsCrous'], NULL);
        }
    }

?>
    <h2>Commentaires :</h2>
<?php

    // Affichage des commentaires

    // Connexion à la base de donnée
    $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , "croustagramadd_bdd")
    or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    // Requête
    $result = mysqli_query($dbLink, 'SELECT * FROM croustacomm WHERE croustapost_id = \'' . $_GET['id'] . '\'');

    if($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            afficher_unique_comm($row['texte'], $row['croustagrameur_id'], $row['date'], $row['pts_crous']);
        }
    }
    ?>

<?php
    if(isset($_SESSION['suid']))
    {
?>
    <form method="post" action="addComment.php">
        <label>Ajouter un commentaire :</label><br>
        <textarea name="commentContent" placeholder="Contenu du commentaire" rows="6" cols="50" required style="resize: none"></textarea>
        <br><button type="submit">Commenter</button>
    </form>
<?php
    }