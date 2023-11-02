<?php

/**
 * Affiche la page de visualisation d'un post précis sur pc
 */

require_once '../controllers/controllerPost.php';
require_once '../controllers/CroustagramGUI.php';
require_once '../controllers/controllerCommentaires.php';

$id = $_GET['id'];

// On affiche le GUI de croustagram
Croustagram("Croustaposte");
?>

<section id="posts">
    <article>
        <?php

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

$post = showOnePost($id);

if($post!==0){
    // On affiche le post
    echo $post;

    // Si il y a un post, on affiche aussi les commentaires
    echo '<h2>Commentaires :</h2>';

    if (isset($_SESSION['username'])){
        showinterfaceAjoutCommentaire();
    }


    echo showCommentaires($id);
}
// Si il n'y a pas de post, on affiche un message d'erreur
else echo '<strong>Ce poste n\'existe pas</strong>';
?>
    </article>
</section>
</body>
