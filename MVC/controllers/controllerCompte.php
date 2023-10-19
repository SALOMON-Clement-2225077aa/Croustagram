<?php
require_once '../controllers/controllerPoste.php';
require_once '../models/modelPoste.php';

function getNbCommentaires($id){

    $data = getNbCommentaireData($id);

    $row = $data->fetch(PDO::FETCH_ASSOC);
    $nb_comm = (int)$row['COUNT(*)']; // Convert to integer
    return $nb_comm;
}

function showPosts($id){

    $data = getAllPostsOfUserData($id);
    $posts = ' ';

    // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        $nb_comm = getNbCommentaires($row['id']);
        $posts = $posts . showPost($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);
    }
    // Libère la variable
    $data->closeCursor();

    return $posts;
}

function showCompte($id){
    $result = getAllCompteData($id);
    $data = $result->fetch(PDO::FETCH_ASSOC);
    if (!empty($data)){
    ?>
    <img id="imgProfil" src="../public/assets/images/profil.png">
    <h1><?php echo $data['pseudo'] . ' (@' . $data['id'] . ')'?></h1>
    <h3>Points crous : <?php echo $data['ptsCrous']?></h3>
    <h5>Dernière connexion le <?php echo $data['derniere_connexion']?></h5>
    <h5>Création du compte le <?php echo $data['creation_compte']?></h5>
<?php
    }
    else{
        echo '<strong>Cet utilisateur n\'existe pas</strong>';
    }
}