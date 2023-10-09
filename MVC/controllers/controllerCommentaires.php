<?php
require '../models/modelCommentaires.php';
function showCommentaires($id){
    $result = getAllCommentaires($id);
    $commentaires = ' ';
    while ($row = mysqli_fetch_assoc($result)) {
        $commentaires . '<section id="commentaire">';
        $commentaires . showOneCommentaire($row['texte'], $row['croustagrameur_id'], $row['date'], $row['pts_crous']);
        $commentaires . '</section>';
    }
    return $commentaires;
}

function showOneCommentaire($texte, $croustagrameur_id, $date, $pts_crous){
    echo '<h2>' . $croustagrameur_id . '</h2>';
    echo '<h5>' . $date . '</h5>';
    echo '<h3>' . $texte . '</h3>';
}