<?php

/**
 * Affiche la page de visualisation d'un post précis sur pc
 */

require_once '../controllers/controllerPost.php';
require_once '../controllers/CroustagramGUI.php';
require_once '../controllers/controllerCommentaires.php';

$id = $_GET['id'];

echo Croustagram("Croustaposte");
?>

<section id="posts">
    <article>
        <?php

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

$post = showOnePost($id);

if($post!==0){
    echo $post;

    echo '<h2>Commentaires :</h2>';

    if (isset($_SESSION['username'])){
        echo showinterfaceAjoutCommentaire();
    }


    echo showCommentaires($id);
}
else echo '<strong>Ce poste n\'existe pas</strong>';
?>
    </article>
</section>
</body>
