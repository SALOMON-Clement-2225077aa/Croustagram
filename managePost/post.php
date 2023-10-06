<?php
    function afficher_unique_post($titre, $contenu, $auteur, $date, $ptsCrous, $categories)
    {
        echo $titre . '<br>' . $contenu . '<br>' . $auteur . '<br>' . $date . '<br>' . $ptsCrous . '<br>' . $categories . '<br>';
    }
    function afficher_unique_comm($contenu, $auteur, $date, $ptsCrous, $commId, $postId)
    {
        echo $contenu . '<br>' . $auteur . '<br>' . $date . '<br>' . $ptsCrous;
        if (isset($_SESSION['username']) and $_SESSION['username'] === $auteur){
        ?>
        <br>
        <button onclick="window.location.href = 'deleteComm.php?commId=<?php echo $commId ?>&postId=<?php echo $postId ?>'">Supprimer le commentaire</button>

    <?php
        }
        echo '<br><br>';
    }