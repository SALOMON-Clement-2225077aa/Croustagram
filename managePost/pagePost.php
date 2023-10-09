<?php require_once '../MVC/config/connectDatabase.php';
    require 'post.php';
    session_start();
    if (isset($_SESSION['username'])) {
        echo '<label>Connecté en tant que :' . $_SESSION['username'] . '</label>';
    }

    // Affichage du poste

    echo '<button onclick="window.location.href = \'../index.php\'" style="position: fixed; left: 1700px;">Revenir au menu principal</button>';

    // Connexion à la base de donnée
    $connexion = connexion();

    // Requête
    $result = $connexion->query('SELECT * FROM croustapost WHERE id = \'' . $_GET['id'] . '\'');

    if($result)
    {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if(isset($row['categories']))
        {
            afficher_unique_post($row['titre'], $row['message'], $row['croustagrameur_id'], $row['date'], $row['ptsCrous'], $row['categories']);
        }
        else
        {
            afficher_unique_post($row['titre'], $row['message'], $row['croustagrameur_id'], $row['date'], $row['ptsCrous'], NULL);
        }
    }

if (isset($_SESSION['username']) and $row['croustagrameur_id'] === $_SESSION['username']){
    ?>
    <button onclick="window.location.href = 'deletePost.php?id=<?php echo $_GET['id'] ?>'">Supprimer le post</button>
    <?php
}
?>
    <h2>Commentaires :</h2>
<?php

    // Affichage des commentaires

    // Connexion à la base de donnée
    $connexion = connexion();

    // Requête
    $result = $connexion->query('SELECT * FROM croustacomm WHERE croustapost_id = \'' . $_GET['id'] . '\'');

    if($result) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            afficher_unique_comm($row['texte'], $row['croustagrameur_id'], $row['date'], $row['pts_crous'], $row['id'], $_GET['id']);
        }
    }
    ?>

<?php
    if(isset($_SESSION['suid']))
    {
?>
    <form method="post" action="../MVC/models/addComment.php?id=<?php echo $_GET['id'] ?>">
        <label>Ajouter un commentaire :</label><br>
        <textarea name="commentContent" placeholder="Contenu du commentaire" rows="6" cols="50" required style="resize: none"></textarea>
        <br><button type="submit">Commenter</button>
    </form>
<?php
    }